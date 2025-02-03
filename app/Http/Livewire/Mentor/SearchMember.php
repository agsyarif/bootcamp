<?php

namespace App\Http\Livewire\Mentor;

use App\Models\akses_course;
use Livewire\Component;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\exam;
use Livewire\WithPagination;

class SearchMember extends Component
{

    use WithPagination;

    public $search;
    public $segment;
    public $course;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount($course, $segment)
    {

        $this->segment = $segment;
        $this->course = $course;
    }

    public function render()
    {
        $data = $this->course->aksesCourse;
        if ($this->segment == 'member' && $this->search !== null) {
            $search = $this->search;
            $data = $data->filter(function ($item) use ($search) {
                return stripos($item->user->name, $search) !== false;
            });
        }

        return view('livewire.mentor.search-member', compact('data'));
    }
}
