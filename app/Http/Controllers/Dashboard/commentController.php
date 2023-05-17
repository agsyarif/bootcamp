<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\akses_course;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = course::all();
        // return $course;
        return view('pages.Dashboard.comment.create', compact('course'));
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
        $course = course::findOrFail($id);
        $courses = course::all()->count();
        // return $course;
        return view('pages.Dashboard.comment.create', compact('courses', 'course'));

        if (Auth::user()->user_role->name == 'member') {
            $aksesCourse = akses_course::where('user_id', '=', Auth::user()->id)->get();
            $id_course = [];
            foreach ($aksesCourse as $key => $value) {
                $id_course[] = $value->course_id;
            }
            $course = course::whereIn('id', $id_course)->get();
            $courses = $course->count();
            $course = course::findOrFail($id);
            // $course
            return view('pages.Dashboard.comment.create', compact('course', 'courses'));
        } else {
            return redirect()->route('member.dashboard.index');
        }
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
