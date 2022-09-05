<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\akses_course;
use App\Models\course;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use Illuminate\Support\Facades\Auth;

class Next extends Component
{

    public $course_material_id;
    public $nextMateri;
    public $disabled;

    public $akses_course;
    public $detailAkses;

    public function mount($id, $aksesCourse)
    {
        // materi active
        $this->course_material_id = $id;
        // $chapterID = CourseMaterial::findOrFail($this->course_material_id)->pluck('course_lesson_id');

        // $courseID = CourseLesson::findOrFail($chapterID[0]);

        // $akses_course = akses_course::where('course_id', '=', $courseID->course_id)->where('user_id', Auth::user()->id)->get();

        // $this->akses_course = $akses_course;

        // $detail = detailAksesCourse::where('akses_course_id', $this->akses_course[0]->id)->where('course_material_id', $this->course_material_id)->get()->pluck('course_material_id');

        // if (count($detail) > 0) {
        //     $this->detailAkses = $detail;
        // } else {
        //     $this->detailAkses = [0];
        // }

        $this->akses_course = akses_course::where('user_id', Auth::user()->id)->get();
        // ada data

        // $detail = detailAksesCourse::where('akses_course_id', [])

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
            $checklist->akses_course_id = $this->akses_course[0]->id;
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
        if ($this->detailAkses[0] != $this->course_material_id) {
            $checklist = new detailAksesCourse;
            $checklist->akses_course_id = $this->akses_course[0]->id;
            $checklist->course_material_id = $this->course_material_id;
            $checklist->save();
        }

        return redirect()->route('member.dashboard.index');
    }

    public function render()
    {
        return view('livewire.next');
    }
}
