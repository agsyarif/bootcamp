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
use Illuminate\Support\Facades\Cache;

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
        $userId = auth()->user()->id;
        $course = Cache::get('course/show/' . $id . '/' . $userId);
        $activeMaterial = optional($course)->getMaterialById($id);
        if (!$activeMaterial) {
            $activeMaterial = CourseMaterial::findOrFail($id);
            $course = $activeMaterial->courseLesson->course;
            $course = Cache::remember('course/show/'  . $course->id . '/' . $userId, 10 * 60 * 60, function () use ($course) {
                $course = $course->load(['course_lessons.exams', 'course_lessons.courseMaterials']);
                return $course;
            });
        }

        return view('pages.Dashboard.member.course.show', compact('course', 'activeMaterial'));
    }
}
