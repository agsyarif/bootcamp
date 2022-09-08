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
    public $materiTerakhir;

    public function mount($chapter, $id, $aksesCourse)
    {
        // materi active
        $this->course_material_id = $id;

        // course materi terakhir => yang course lesson id nya 11 idnya 7
        $materiTerakhir = CourseMaterial::where('course_lesson_id', $chapter)->orderBy('id', 'desc')->limit(1)->pluck('id');
        $this->materiTerakhir = $materiTerakhir[0];
        // ambil exam dari chapter yang sedang dibuka
        $exam = exam::where('course_lesson_id', $chapter)->get();
        // return $exam;

        $this->chapter;

        if ($exam != null) {
            foreach ($exam as $key => $value) {
                $this->exam = $value->id;
                if ($value->course_lesson_id == $chapter) {
                    if ($id == $materiTerakhir[0]) {
                        if (request()->segment(3) == 'result') {
                            $this->tombol = 'next';
                        } else {
                            $this->tombol = 'uji';
                        }
                    } else {
                        $this->tombol = 'next';
                    }
                } else {
                    if ($id == $materiTerakhir[0]) {
                        $this->tombol = 'selesai';
                    } else {
                        $this->tombol = 'next';
                    }
                }
            }
        } else {
            $this->tombol = 'next';
        }

        $this->chapter = $chapter;
        $this->akses_course = $aksesCourse;
        $detail_akses = detailAksesCourse::where('akses_course_id', $aksesCourse)->where('course_material_id', $this->course_material_id)->get()->pluck('course_material_id');
        if (count($detail_akses) > 0) {
            $this->detailAkses = $detail_akses;
        } else {
            $this->detailAkses = [0];
        }
    }

    // next materi
    public function nextMateri()
    {
        if ($this->detailAkses[0] != $this->course_material_id) {
            $checklist = new detailAksesCourse;
            $checklist->akses_course_id = $this->akses_course;
            $checklist->course_material_id = $this->course_material_id;
            $checklist->save();
        }

        $nextMateri = CourseMaterial::where('id', '>', $this->course_material_id)->first();

        if ($nextMateri) {
            return redirect()->route('member.course.materi', [$nextMateri->id]);
            $this->disabled = false;
        } else {
            $this->disabled = true;
        }
    }

    public function selesai()
    {
        // if ($this->detailAkses[0] != $this->course_material_id) {
        //     $checklist = new detailAksesCourse;
        //     $checklist->akses_course_id = $this->akses_course[0]->id;
        //     $checklist->course_material_id = $this->course_material_id;
        //     $checklist->save();
        // }

        return redirect()->route('member.dashboard.index');
    }

    public function kuis()
    {
        if ($this->detailAkses[0] != $this->course_material_id) {
            $checklist = new detailAksesCourse;
            $checklist->akses_course_id = $this->akses_course;
            $checklist->course_material_id = $this->course_material_id;
            $checklist->save();
        }

        return redirect()->route('member.course.quiz', [$this->chapter]);
        // return redirect()->route('')
    }

    public function render()
    {
        return view('livewire.next');
    }
}
