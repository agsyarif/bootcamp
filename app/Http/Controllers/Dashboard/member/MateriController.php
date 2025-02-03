<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Models\CourseMaterial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil($id)
    {
        $userId = auth()->id();
        $course = Cache::get("course/show/{$id}/{$userId}");
        $activeMaterial = $course ? $course->getMaterialById($id) : CourseMaterial::findOrFail($id);

        if (!$course) {
            $activeMaterial->load('courseLesson.course');
            $course = Cache::remember("course/show/{$activeMaterial->courseLesson->course->id}/{$userId}", 10 * 60 * 60, function () use ($activeMaterial) {
                return $activeMaterial->courseLesson->course->load(['course_lessons.exams', 'course_lessons.courseMaterials']);
            });
        }

        return view('pages.Dashboard.member.course.show', compact('course', 'activeMaterial'));
    }
}
