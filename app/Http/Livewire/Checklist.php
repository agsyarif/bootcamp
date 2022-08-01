<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\detailAksesCourse;

class Checklist extends Component
{
    public $materi_id;
    public $checklist;

    public function mount($id)
    {
        $this->materi_id = $id;

        $check = detailAksesCourse::where('course_material_id', '=', $id)->get();
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
