<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
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

    public function aksi($aksi)
    {
        $this->action = $aksi;
        // if ($aksi == 'terbaru') {
        //     $this->action = "where('created_at', 'desc')";
        // } elseif ($aksi == 'active') {
        //     $this->action = "where('status', '1')";
        // }
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
            // $this->results = User::where('user_role_id', 2)->orderBy('updated_at', 'desc')->paginate(10);
        }

        return view('livewire.admin.search');
        // return view('livewire.admin.search', [
        //     'kembali' => $this->results,
        // ]);
    }
}
