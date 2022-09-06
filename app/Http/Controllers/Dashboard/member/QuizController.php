<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Models\exam;
use App\Models\course;
use App\Models\question;
use App\Models\akses_course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function start($id)
    {

        // untuk tampilan yang active
        $ChapterActive = CourseLesson::findOrFail($id);
        $MateriActive = CourseMaterial::where('course_lesson_id', '=', $ChapterActive->id)->get();
        $CourseActive = course::where('id', '=', $ChapterActive->course_id)->get();

        $exam = exam::where('course_lesson_id', '=', $ChapterActive->id)->get();
        $examId = [];
        foreach ($exam as $key => $value) {
            $examId[] = $value->id;
        }

        if ($examId != null) {
            $question = question::whereIn('exam_id', $examId)->get();
        } else {
            $question = null;
        }

        // $question = question::whereIn('exam_id', $examId)->get();


        // untuk Semua
        $chapter = CourseLesson::where('course_id', '=', $CourseActive[0]->id)->get();
        $chapterId = [];
        foreach ($chapter as $key => $value) {
            $chapterId[] = $value->id;
        }
        $id = $examId;
        $material = CourseMaterial::whereIn('course_lesson_id', $chapterId)->get();
        $active = 'course';

        return view('pages.Dashboard.member.quiz.start', compact('MateriActive', 'ChapterActive', 'CourseActive', 'chapter', 'material', 'active', 'exam', 'question', 'examId', 'id'));
    }

    public function result($score, $examId)
    {
        $examActive = exam::findOrFail($examId);
        $chapterActive = CourseLesson::findOrFail($examActive->course_lesson_id);
        $MateriActive = CourseMaterial::where('course_lesson_id', $chapterActive->id)->orderBy('id', 'desc')->limit(1)->get();
        $aksesCourse = akses_course::where('course_id', '=', $chapterActive->course_id)->where('user_id', '=', Auth::user()->id)->get();
        $chapter = CourseLesson::where('course_id', '=', $chapterActive->course_id)->get();
        $chapterId = [];
        foreach ($chapter as $key => $value) {
            $chapterId[] = $value->id;
        }
        $exam = exam::whereIn('id', $chapterId)->get();

        $material = CourseMaterial::whereIn('course_lesson_id', $chapterId)->get();
        $active = 'course';



        return view('pages.Dashboard.member.quiz.result', compact('examActive', 'score', 'chapterActive', 'chapter', 'material', 'exam', 'MateriActive', 'aksesCourse'));
    }
}
