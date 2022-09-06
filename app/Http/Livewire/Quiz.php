<?php

namespace App\Http\Livewire;

use App\Models\CourseLesson;
use App\Models\exam;
use Livewire\Component;
use App\Models\question;
use Livewire\WithPagination;
use App\Models\CourseMaterial;

class Quiz extends Component
{
    use WithPagination;

    public $exam_id;
    public $question_id;
    // protected $paginationTheme
    protected $paginationTheme = 'bootstrap';
    public $selectedAnswer = [];
    public $jawaban = [];
    public $score;
    public $quessssss;
    public $exammm;
    public $materiTerakhir;

    public function mount($id, $segment)
    {
        $this->segment = $segment;
        $this->exam_id = $id;
    }

    public function answers($questionId, $option)
    {
        $this->jawaban[$questionId] =  $questionId . '-' . $option;
    }

    public function submitAnswer()
    {
        if (count($this->jawaban) > 0) {
            foreach ($this->jawaban as $key => $value) {
                $this->selectedAnswer[] = $value;
                // mencocokan jawaban dengan database
                $questionanswer = question::findOrFail($key)->answer;

                $userAnswer = substr($value, strpos($value, '-') + 1);
                $total = question::where('id', $key)->get();
                $tot = $total[0]->exam_id;
                $tt = question::where('exam_id', $tot)->count();
                $bobot = 100 / $tt;
                $score = $this->score;
                if ($userAnswer == $questionanswer) {
                    $this->score = $score + $bobot;
                }
            }
        } else {
            $this->score = 0;
        }

        $update = exam::findOrFail($this->exam_id[0]);
        $update->score = $this->score;
        $update->save();

        // $materiTerakhir = CourseMaterial::where('course_lesson_id', $chapterActive)->orderBy('id', 'desc')->limit(1)->pluck('id');

        return redirect()->route('member.quiz.result', [$this->score, $this->exam_id[0]]);
    }


    // public function customPagination()
    // {

    //     return 'custom-pagination';
    // }

    public function render()
    {
        if ($this->segment == 'start') {

            return view('livewire.quiz', [
                'questions' => question::where('exam_id', $this->exam_id)->paginate(1),
                'exam' => exam::findOrFail($this->exam_id)
            ]);
        } elseif ($this->segment == 'result') {

            $courseLessonId = exam::where('course_lesson_id', $this->exam_id)->get();
            $this->materiTerakhir = CourseMaterial::where('course_lesson_id', $courseLessonId[0]->id)->orderBy('id', 'desc')->limit(1)->pluck('id');
            return view('livewire.result');
        }
    }

    // public function paginationView()
    // {

    //     return 'custom-pagination';
    // }
}
