<?php

namespace App\Http\Controllers\Dashboard\mentor;

use App\Models\exam;
use App\Models\type;
use App\Models\course;
use App\Models\question;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index(Request $request){
        //
    }

    public function create($courseId, $examId)
    {
        return $courseId;
    }

    public function show($id)
    {
        // punya exam
        $exam = exam::findOrFail($id);

        $userId = auth()->user()->id;

        $examAll = Exam::whereHas('courseLesson', function ($q) use ($userId) {
            $q->whereHas('course', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        })->get();

        $type = type::all();

        return view('pages.Dashboard.mentor.question.create', compact('exam', 'type', 'examAll', 'id'));

        // $course = $exam->courseLesson->course;
        // $exam = $exam->load('courseLesson.')

        // CourseLesson::where('course_id')

        // $exam = exam::where('id', $id)->get();
        // $exam = exam::findOrFail($id);
        // $examAll = exam::all();
        // $courses = course::all()->count();
        // $chapter = CourseLesson::where('course_id', '=', $exam->course_id)->get();
        // // return $chapter;
        // $type = type::all();
        // return view('pages.Dashboard.mentor.question.create', compact('exam', 'type', 'courses', 'examAll', 'chapter', 'id'));
        // $examAll = exam::all();
        // $question = question::where('exam_id', $id)->get();
        // $courses = course::all();
        // return view('pages.Dashboard.mentor.question.index', compact('exam', 'examAll', 'question', 'courses'));
    }

    public function store(Request $request)
    {
        $currentExam = $request->Exam_id;

        $question = new question;
        $question->exam_id = $request->Exam_id;
        $question->type_id = $request->type_id ?? 1;
        $question->title = $request->soal;
        // $question->chapter_id = $request->chapter;
        $question->answer = $request->answer;
        $question->option1 = $request->opsiA;
        $question->option2 = $request->opsiB;
        $question->option3 = $request->opsiC;
        $question->option4 = $request->opsiD;
        $question->explanations = $request->explanation;
        $question->save();

        toast()->success("Add Question Has Been Success");
        return redirect()->route('exam.show', $currentExam);
    }

    public function edit($id)
    {

        $question = question::findOrFail($id);

        $userId = auth()->user()->id;
        $exam = Exam::whereHas('courseLesson', function ($q) use ($userId) {
            $q->whereHas('course', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        })->get();

        $type = type::all();
        return view('pages.Dashboard.mentor.question.edit', compact('question', 'exam', 'type'));


        // $question = question::findOrFail($id);
        // $exam = exam::all();
        // $type = type::all();
        // $courses = course::all()->count();
        // return view('pages.Dashboard.mentor.question.edit', compact('question', 'exam', 'type', 'courses'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'Exam_id' => 'required',
            // 'type_id' => 'required',
            'soal' => 'required',
            'answer' => 'required',
            'opsiA' => 'required',
            'opsiB' => 'required',
            'opsiC' => 'required',
            'opsiD' => 'required',
            'explanation' => 'required',
        ]);

        $dataQuestion = [
            'exam_id' => $request->Exam_id,
            'type_id' => $request->type_id ?? 1,
            'title' => $request->soal,
            'answer' => $request->answer,
            'option1' => $request->opsiA,
            'option2' => $request->opsiB,
            'option3' => $request->opsiC,
            'option4' => $request->opsiD,
            'explanations' => $request->explanation,
        ];

        $question = question::findOrFail($id);
        $update = $question->update($dataQuestion);

        // $question = question::findOrFail($id);
        // $question->exam_id = $request->Exam_id;
        // $question->type_id = $request->type_id;
        // $question->title = $request->soal;
        // $question->answer = $request->answer;
        // $question->option1 = $request->opsiA;
        // $question->option2 = $request->opsiB;
        // $question->option3 = $request->opsiC;
        // $question->option4 = $request->opsiD;
        // $question->explanations = $request->explanation;
        // $question->save();

        // return $request->all();

        // $question = question::findOrFail($id);
        // $question->exam_id = $request->Exam_id;
        // $question->type_id = $request->type_id;

        if (!$update) {
            toast()->error("Data gagal di update.");
            return redirect()->route('exam.show', $question->Exam_id);
        }

        toast()->success("Data berhasil di update.");
        return redirect()->route('exam.show', $question->exam_id);
    }

    public function destroy($id)
    {
        $question = question::findOrFail($id);
        $question->delete();
        toast()->success("Delete Question Has Been Success");
        return redirect()->route('exam.show', $question->exam_id);
    }
}
