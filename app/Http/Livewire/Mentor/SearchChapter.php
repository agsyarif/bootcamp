<?php

namespace App\Http\Livewire\Mentor;

use Livewire\Component;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\exam;
use Livewire\WithPagination;

class SearchChapter extends Component
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
        $data = CourseLesson::where('course_id', '=', $this->course->id)->get();

        if ($this->segment == 'chapter') {
            if ($this->search !== null) {

                $data = CourseLesson::where('course_id', $this->course->id)->where('title', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->get();
                $materi = CourseMaterial::all();
            } else {
                CourseLesson::where('course_id', '=', $this->course->id)->orderBy('created_at', 'desc')->get();
                $materi = CourseMaterial::all();
            }
            return view('livewire.mentor.search-chapter', compact('data', 'materi'));
        }
        return view('livewire.mentor.search-chapter', compact('data'));
    }
}
