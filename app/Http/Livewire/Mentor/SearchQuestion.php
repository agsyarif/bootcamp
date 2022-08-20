<?php

namespace App\Http\Livewire\Mentor;

use App\Models\exam;
use App\Models\question;
use App\Models\type;
use Livewire\Component;
use Livewire\WithPagination;

class SearchQuestion extends Component
{
    use WithPagination;

    public $search;
    public $segment;
    public $exam;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount($exam, $segment)
    {

        $this->segment = $segment;
        $this->exam = $exam;
    }

    public function render()
    {

        if ($this->segment == 'question') {
            if ($this->search !== null) {
                $data = question::where('exam_id', $this->exam->id)->where('title', 'like', '%' . $this->search . '%')->orWhere('exam_id', $this->exam->id)->where('answer', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->get();
                $type = type::all();
            } else {
                $data = question::where('exam_id', '=', $this->exam->id)->get();
                $type = type::all();
            }
            return view('livewire.mentor.search-question', compact('data', 'type'));
        }

        return view('pages.Dashboard.mentor.exam.index');
    }
}
