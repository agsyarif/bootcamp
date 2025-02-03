<?php

namespace App\Http\Livewire\Admin;

use App\Models\exam;
use App\Models\User;
use App\Models\course;
use Livewire\Component;
use App\Models\CourseLesson;
use Livewire\WithPagination;
use App\Models\checkout_course;
use App\Models\question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Search extends Component
{

    use WithPagination;

    public $search;
    public $segment;
    public $limitPerPage = 10;
    public $isi;
    public $action;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount($segment)
    {
        $this->segment = $segment;
    }

    public function render()
    {

        if ($this->segment == 'mentor-management') {

            $data = User::role('Mentor');

            if ($this->search !== null) {
                $data = $data->where('name', 'like', '%' . $this->search . '%')
                    ->Where('email', 'like', '%' . $this->search . '%')
                    ->orderBy('updated_at', 'desc');

            } else {
                $data = $data->orderBy('updated_at', 'desc');
            }

            $data = $data->get();
            // $data = $data->paginate(5)->withQueryString();

            return view('livewire.admin.search', compact('data'));

        } else if ($this->segment == 'member-management') {

            $data = User::role('Member');

            if ($this->search !== null) {
                $data = $data->where('name', 'like', '%' . $this->search . '%')->Where('email', 'like', '%' . $this->search . '%')->orderBy('updated_at', 'desc')->get();
            } else {
                $data = $data->orderBy('updated_at', 'desc')->get();
            }

            return view('livewire.admin.member', compact('data'));
        } else if ($this->segment == 'transaksi') {
            if ($this->search !== null) {
                $data = checkout_course::where('payment_status', 'like', '%' . $this->search . '%')->orWhere('midtrans_booking_code', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->get();
            } else {
                $data = checkout_course::orderBy('created_at', 'desc')->get();
            }
            return view('livewire.admin.transaksi', compact('data'));
        } else if ($this->segment == 'course') {
            $userId = Auth::id();
            $authRoles = auth()->user()->roles->pluck('name')->first();

            $data = course::with('aksesCourse');
            if($authRoles === 'Mentor') {
                $data->where('user_id', $userId);
            }

            if ($this->search) {
                $data = $data->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%')->get();
            } else {
                $data = $data->get();
            }

            return view('livewire.mentor.course', compact('data'));
        } else if ($this->segment == 'exam') {
            if ($this->search !== null) {

                $mentor = Auth::user()->id;
                $course = course::where('user_id', $mentor)->orderBy('updated_at', 'desc')->get();
                $exam = exam::where('title', 'like', '%' . $this->search . '%')->orderBy('updated_at', 'desc')->get();
                $question = question::all();
                if (count($course) > 0) {
                    foreach ($exam as $key => $value) {
                        $course_id = CourseLesson::where('id', $value->course_lesson_id)->pluck('course_id');
                        $exam[$key]->course = course::where('id', $course_id)->pluck('name');
                    }
                } else {
                    $exam->course = '-';
                }
                $data = $exam;
            } else {
                $mentor = Auth::user()->id;
                $course = course::where('user_id', $mentor)->orderBy('updated_at', 'desc')->get();
                $exam = exam::all();
                $data = exam::all();
                $question = question::all();
                if (count($course) > 0) {
                    foreach ($exam as $key => $value) {
                        $course_id = CourseLesson::where('id', $value->course_lesson_id)->pluck('course_id');
                        $exam[$key]->course = course::where('id', $course_id)->pluck('name');
                    }
                } else {
                    $exam->course = '-';
                }
                $data = $exam;
            }
            return view('livewire.mentor.search-exam', compact('data', 'question'));
        } else if ($this->segment == 'kelasAdmin') {
            // $data = course::all();
            if ($this->search !== null) {
                $data = course::where('name', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->orWhere('price', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->orWhere('created_at', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->get();
            } else {
                $data = course::orderBy('created_at', 'desc')->get();
            }

            return view('livewire.admin.course', compact('data'));
        }

        return view('livewire.admin.search');
    }
}
