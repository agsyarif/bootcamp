<?php

namespace App\Http\Livewire;

use App\Models\comment as ModelsComment;
use App\Models\course;
use App\Models\CourseCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{

    use WithPagination;

    public $rating;
    public $comment;
    public $currentId;
    public $course;
    public $hideForm;

    protected $rules = [
        'rating' => ['required', 'in:1,2,3,4,5'],
        'comment' => 'required',

    ];

    public function render()
    {

        $comments = ModelsComment::where('course_id', $this->currentId)->where('status', 1)->with('user')->get();

        return view('livewire.comment', [
            'comments' => $comments,
        ]);
    }

    public function mount($id)
    {
        $this->course = course::findOrFail($id);

        if (auth()->user()) {
            $rating = ModelsComment::where('user_id', auth()->user()->id)->where('course_id', $id)->orderBy('created_at', 'desc')->first();

            // $rating = ModelsComment::where('user_id', auth()->user()->id)->where('course_id', $id)->first();;
            if (!empty($rating)) {
                $this->rating = $rating->rating;
                $this->comment = $rating->comment;
                $this->currentId = $rating->id;
            }
            return view('livewire.comment');
        }
    }

    public function delete($id)
    {

        $rating = ModelsComment::where('id', $id)->first();
        if ($rating && ($rating->user_id == auth()->user()->id)) {
            $rating->delete();
        }

        if ($this->currentId) {
            $this->rating = '';
            $this->comment = '';
            $this->currentId = '';
        }
    }

    public function rate()
    {
        // $rating = ModelsComment::where('user_id', auth()->user()->id)->where('course_id', $this->currentId)->first();
        // ambil data terakhir yang ditambahkan
        $rating = ModelsComment::where('user_id', auth()->user()->id)->where('course_id', $this->currentId)->orderBy('created_at', 'desc')->first();
        $this->validate();
        if (!empty($rating)) {
            $rating->user_id = auth()->user()->id;
            $rating->course_id = $this->course->id;
            $rating->rating = $this->rating;
            $rating->comment = $this->comment;
            $rating->status = 1;
            try {
                $rating->update();
            } catch (\Throwable $th) {
                throw $th;
            }
            session()->flash('message', 'Success!');
        } else {
            $rating = new ModelsComment;
            $rating->user_id = auth()->user()->id;
            $rating->course_id = $this->course->id;
            $rating->rating = $this->rating;
            $rating->comment = $this->comment;
            $rating->status = 1;
            try {
                $rating->save();
            } catch (\Throwable $th) {
                throw $th;
            }
            $this->hideForm = true;
        }
        return redirect()->route('mentor.dashboard.index');
    }
}
