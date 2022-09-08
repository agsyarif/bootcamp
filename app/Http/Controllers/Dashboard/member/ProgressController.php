<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Models\course;
use App\Models\akses_course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use App\Models\nilai;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // user yang sedang login
        $akses = Auth::user()->user_role_id;
        // ambil data akses course yang diakses oleh user Auth
        $aksesCourse = akses_course::where('user_id', '=', Auth::user()->id)->get();
        $id_course = [];
        foreach ($aksesCourse as $key => $value) {
            $id_course[] = $value->course_id;
        }
        $akses_id = [];
        foreach ($aksesCourse as $key => $value) {
            $akses_id[] = $value->id;
        }

        // ambl data course yang menjadi akses dari useer Auth
        $course = course::whereIn('id', $id_course)->get();
        $active = 'progress';
        $courses = count($course);

        // chapter in all
        $chapter = CourseLesson::whereIn('course_id', $id_course)->get();
        $id_chapter = [];
        foreach ($chapter as $key => $value) {
            $id_chapter[] = $value->id;
        }
        $materi = CourseMaterial::whereIn('course_lesson_id', $id_chapter)->get();

        $progress = detailAksesCourse::whereIn('akses_course_id', $akses_id)->get();

        $persentase = $progress->count() / $materi->count() * 100;
        // $persentase = 7 / 18 * 100;
        $persen = number_format($persentase, 0, '.', '');

        // jumlah nilai member
        $nilai = nilai::whereIn('akses_course_id', $akses_id)->get();
        $jumlah = 0;
        foreach ($nilai as $key => $value) {
            $jumlah += $value->score;
        }

        // jumlah exam yang telah dikerjakan => nilai maksimum yang bisa didapatkan (A)
        // jumlah nilai keseluruhan => jumlah nilai yang anda dapatkan (B)
        // rumus = B / A * 100
        //       = .....%
        // $persentase_nilai = 250 / (4 * 100) * 100;

        $persentase_nilai = $jumlah / ($nilai->count() * 100) * 100;

        return view('pages.Dashboard.member.progress.index', compact('aksesCourse', 'course', 'active', 'courses', 'progress', 'materi', 'persen', 'nilai', 'persentase_nilai'));
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
        //
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
