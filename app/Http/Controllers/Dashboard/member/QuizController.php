<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Models\exam;
use App\Models\course;
use App\Models\question;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Http\Controllers\Controller;

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
        $chapter = CourseLesson::where('course_id', '=', $chapterActive->course_id)->get();
        $chapterId = [];
        foreach ($chapter as $key => $value) {
            $chapterId[] = $value->id;
        }
        $exam = exam::whereIn('id', $chapterId)->get();

        $material = CourseMaterial::whereIn('course_lesson_id', $chapterId)->get();
        $active = 'course';


        return view('pages.Dashboard.member.quiz.result', compact('examActive', 'score', 'chapterActive', 'chapter', 'material', 'exam'));
    }
}
