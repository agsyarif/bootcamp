<?php

namespace App\Http\Controllers\Dashboard\mentor;

use App\Http\Controllers\Controller;
use App\Models\answerUser;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $answerUser = answerUser::findOrFail($id);

        $courseUser = course::where('user_id', '=', Auth::user()->id);
        $course = $courseUser->get();
        $currentCourse = $courseUser->whereHas('aksesCourse', function ($q) use ($id) {
            $q->where('course_id', $id);
        })->get();
        $courses = $course->count();

        return view('pages.Dashboard.mentor.examScore.answerUser.priview', compact(['answerUser', 'courses', 'currentCourse']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
