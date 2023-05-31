<?php

namespace App\Http\Livewire;

use App\Models\akses_course;
use App\Models\answerUser;
use App\Models\CourseLesson;
use App\Models\exam;
use Livewire\Component;
use App\Models\question;
use Livewire\WithPagination;
use App\Models\CourseMaterial;
use App\Models\nilai;
use Illuminate\Support\Facades\Auth;

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
        $answer = [];
        if (count($this->jawaban) > 0) {
            foreach ($this->jawaban as $key => $value) {
                $this->selectedAnswer[] = $value;
                $is_true = 0;
                // mencocokan jawaban dengan database
                $question = question::findOrFail($key);
                $questionanswer = $question->answer;

                $userAnswer = substr($value, strpos($value, '-') + 1);
                $total = question::where('id', $key)->get();
                $tot = $total[0]->exam_id;
                $tt = question::where('exam_id', $tot)->count();
                $bobot = 100 / $tt;
                $score = $this->score;
                if ($userAnswer == $questionanswer) {
                    $is_true = 1;
                    $this->score = $score + $bobot;
                }

                $answer[] = [
                    'questionId' => $question->id,
                    'option1' => $question->option1,
                    'option2' => $question->option2,
                    'option3' => $question->option3,
                    'option4' => $question->option4,
                    'userAnswer' => $userAnswer,
                    'questionAnswer' => $questionanswer,
                    'is_true' => $is_true
                ];
            }
        } else {
            $this->score = 0;
        }

        $exam = exam::findOrFail($this->exam_id[0]);
        $course = $exam->courseLesson->course;
        $aksesCourse = akses_course::where('course_id', $course->id)->where('user_id', Auth::user()->id)->get();

        // buat data nilai baru di table answer_user
        $dataNilai = answerUser::where('exam_id', $exam->id)->where('akses_course_id', $aksesCourse[0]->id)->first();

        if ($dataNilai == null) {
            $answerUser = answerUser::create([
                'exam_id' => $this->exam_id[0],
                'akses_course_id' => $aksesCourse[0]->id,
                'answers' => json_encode($answer),
                'score' => $this->score,
            ]);
        } else {
            $dataNilai->update([
                'answers' => json_encode($answer),
                'score' => $this->score,
            ]);
        }

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
            $this->materiTerakhir = CourseMaterial::where('course_lesson_id', $this->exam_id)->orderBy('id', 'desc')->limit(1)->pluck('id');
            return view('livewire.result');
        }
    }

    // public function paginationView()
    // {

    //     return 'custom-pagination';
    // }
}
