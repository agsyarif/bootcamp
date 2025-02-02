<?php

namespace App\Http\Livewire\Mentor;

use App\Models\akses_course;
use Livewire\Component;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\exam;
use Livewire\WithPagination;

class examScoreMember extends Component
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
        // $data = $this->course->akses_course;

        // if ($this->segment == 'member') {
        //     if ($this->search !== null) {
        //         $search = $this->search;
        //         $data = akses_course::where('course_id', $this->course->id)
        //             ->whereHas('user', function ($q) use ($search) {
        //                 $q->where('name', 'like', '%' . $search . '%');
        //             })
        //             ->get();
        //     }
        // }
        return 'ssaa';
        // return view('livewire.mentor.search-member', compact('data'));
    }
}
