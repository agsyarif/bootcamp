<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\akses_course;
use App\Models\course;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use App\Models\exam;
use App\Models\nilai;
use Illuminate\Support\Facades\Auth;

class Next extends Component
{

    public $course_material_id;
    public $nextMateri;
    public $disabled;

    public $akses_course;
    public $detailAkses;
    public $chapter;

    public $tombol;
    public $exam;
    public $course;
    public $latestChapter;

    public function mount($chapter, $material, $aksesCourse)
    {
        $materialId = $material->id;
        $latestMaterial = $chapter->latestMaterial();
        $course = $chapter->course;
        $latestChapter = $course->latestLesson();
        $exam = count($chapter->exams) != 0 ? $chapter->exams : null;
        if ($materialId == $latestMaterial->id) {
            if ($chapter->id == $latestChapter->id) {
                $this->tombol = 'selesai';
            }
            if ($exam == null || request()->segment(3) == 'result') {
                $this->tombol = 'next';
            } else {
                $this->tombol = 'quiz';
            }
        } else {
            $this->tombol = 'next';
        }

        $this->course_material_id = $materialId;
        $this->chapter = $chapter;
        $this->akses_course = $aksesCourse;
        $this->course = $course;
        $this->detailAkses = $aksesCourse->getDetailByMaterial($materialId);
    }

    // next materi
    public function nextMateri()
    {
        if ($this->detailAkses == null) {
            detailAksesCourse::updateOrCreate([
                'akses_course_id' => $this->akses_course->id,
                'course_material_id' => $this->course_material_id
            ]);
        }

        $nextMateri = $this->chapter->getMatetialAfterThisId($this->course_material_id);
        $this->nextMateri = $nextMateri;
        if ($nextMateri) {
            $this->disabled = false;
            return redirect()->route('member.course.materi', [$nextMateri->id]);
        } else {
            $nextMateri = optional(optional($this->course)->getChapterAfterThisId($this->chapter->id))->getMatetialAfterThisId($this->course_material_id);
            if ($nextMateri == null) {
                $this->tombol = 'selesai';
                $this->disabled = true;
            } else {
                $this->disabled = false;
                return redirect()->route('member.course.materi', [$nextMateri->id]);
            }
        }
    }

    public function selesai()
    {
        return redirect()->route('member.dashboard.index');
    }

    public function kuis()
    {
        if ($this->detailAkses == null) {
            detailAksesCourse::create([
                'akses_course_id' => $this->akses_course->id,
                'course_material_id' => $this->course_material_id
            ]);
        }

        return redirect()->route('member.course.quiz', [$this->chapter]);
    }

    public function render()
    {
        return view('livewire.next');
    }
}
