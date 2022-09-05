<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Models\exam;
use App\Models\course;
use App\Models\question;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use App\Http\Controllers\Controller;
use App\Models\akses_course;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil($id)
    {

        // data khusus atau data aktif sekarang//
        // $MateriActive = CourseMaterial::where('id', '=', $id)->get();
        // $courses = course::findOrFail($id);
        $MateriActive = CourseMaterial::findOrFail($id);
        $ChapterActive = CourseLesson::where('id', $MateriActive->course_lesson_id)->get();
        $CourseActive = course::where('id', $ChapterActive[0]->course_id)->get();
        $courses = $CourseActive[0];

        // semua data //
        $chapter = CourseLesson::where('course_id', '=', $CourseActive[0]->id)->get();
        $chapterId = [];
        foreach ($chapter as $key => $value) {
            $chapterId[] = $value->id;
        }
        $material = CourseMaterial::whereIn('course_lesson_id', $chapterId)->get();
        $active = 'course';
        $exam = exam::whereIn('course_lesson_id', $chapterId)->get();
        $question = question::where('exam_id', '=', $exam[0]->id)->get();

        $aksesCourse = akses_course::where('course_id', '=', $courses->id)->where('user_id', '=', Auth::user()->id)->get();

        // return dd($data);
        return view('pages.Dashboard.member.course.show', compact('courses', 'MateriActive', 'ChapterActive', 'CourseActive', 'chapter', 'material', 'active', 'exam', 'question', 'aksesCourse'));
    }
}
