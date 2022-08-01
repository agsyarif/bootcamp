<?php

namespace App\Http\Livewire;

use App\Models\akses_course;
use Livewire\Component;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;

class Next extends Component
{

    public $course_material_id;
    public $nextMateri;
    public $disabled;

    public $akses_course;
    public $detailAkses;

    public function mount($id)
    {
        $this->course_material_id = $id;
        $this->akses_course = akses_course::where('user_id', auth()->user()->id)->get();

        $detail_akses = detailAksesCourse::where('course_material_id', $this->course_material_id)->get()->pluck('course_material_id');
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
