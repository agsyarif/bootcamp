<?php

namespace App\Http\Livewire\Admin;

use App\Models\checkout_course;
use App\Models\course;
use App\Models\CourseLesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

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

            if ($this->search !== null) {
                $data = User::where('user_role_id', 2)->where('name', 'like', '%' . $this->search . '%')->orWhere('user_role_id', 2)->Where('email', 'like', '%' . $this->search . '%')->orderBy('updated_at', 'desc')->get();
            } else {
                $data = User::where('user_role_id', 2)->orderBy('updated_at', 'desc')->get();
            }
            return view('livewire.admin.search', compact('data'));
        } else if ($this->segment == 'member-management') {
            if ($this->search !== null) {
                $data = User::where('user_role_id', 3)->where('name', 'like', '%' . $this->search . '%')->orWhere('user_role_id', 3)->Where('email', 'like', '%' . $this->search . '%')->orderBy('updated_at', 'desc')->get();
            } else {
                $data = User::where('user_role_id', 3)->orderBy('updated_at', 'desc')->get();
            }
            return view('livewire.admin.member', compact('data'));
        } else  if ($this->segment == 'transaksi') {
            if ($this->search !== null) {
                $data = checkout_course::where('payment_status', 'like', '%' . $this->search . '%')->orWhere('midtrans_booking_code', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->get();
            } else {
                $data = checkout_course::orderBy('created_at', 'desc')->get();
            }
            return view('livewire.admin.transaksi', compact('data'));
        } else if ($this->segment == 'course') {
            if ($this->search !== null) {
                $mentor = Auth::user()->id;
                $data = course::where('user_id', $mentor)->where('name', 'like', '%' . $this->search . '%')->orWhere('user_id', $mentor)->where('price', 'like', '%' . $this->search . '%')->orderBy('updated_at', 'desc')->get();
            } else {
                $data = course::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
            }

            return view('livewire.mentor.course', compact('data'));
        }

        return view('livewire.admin.search');
    }
}
