<?php

namespace App\Http\Livewire;

use App\Models\akses_course;
use Livewire\Component;
use App\Models\detailAksesCourse;
use Illuminate\Support\Facades\Auth;

class Checklist extends Component
{
    public $materi_id;
    public $checklist;

    public function mount($id, $CourseActive)
    {
        $this->materi_id = $id;

        $user = Auth::user()->id;

        $aksesCourse = akses_course::where('course_id', $CourseActive)->where('user_id', '=', Auth::user()->id)->get();

        $check = detailAksesCourse::where('akses_course_id', '=', $aksesCourse[0]->id)->where('course_material_id', '=', $id)->get();

        // $check = detailAksesCourse::where('course_material_id', '=', $id)->get();
        if (count($check) > 0) {
            $this->checklist = 1;
        } else {
            $this->checklist = 0;
        }
    }

    public function render()
    {
        return view('livewire.checklist');
    }
}
