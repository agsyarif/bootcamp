<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Http\Controllers\Controller;
use App\Models\akses_course;
use App\Models\checkout_course;
use App\Models\course;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use App\Models\exam;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $course = Cache::remember('course/' . $userId, 10 * 60 * 60, function () use ($userId) {
            return akses_course::where('user_id', '=', $userId)->get();
        });
        $active = 'course';
        $courses = count($course);
        return view('pages.Dashboard.member.course.index', compact('course', 'active', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $course = course::find($id);
        // $course = $course->load(['course_lessons.exams', 'course_lessons.courseMaterials']);

        $userId = auth()->user()->id;
        $course = Cache::remember('course/show/' . $userId, 10 * 60 * 60, function () use ($id) {
            $course = course::find($id);
            $course = $course->load(['course_lessons.exams', 'course_lessons.courseMaterials']);
            return $course;
        });

        $activeMaterial = $course->firstLesson()->firstMaterial();

        return view('pages.Dashboard.member.course.show', compact('course', 'activeMaterial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function materi()
    {
    }
}
