<?php

namespace App\Http\Controllers\Dashboard\member;

use App\Models\course;
use App\Models\akses_course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\answerUser;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use App\Models\nilai;
use App\Services\ProgressService;
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

        $userId = auth()->user()->id;
        $aksesCourse = akses_course::where('user_id', '=', $userId)
            ->with(['course.course_lessons.courseMaterials', 'detail_akses_course'])
            ->get();

        $serviceProgress = new ProgressService($aksesCourse);
        $progress = $serviceProgress->progress();


        // dd($progress);
        // foreach ($aksesCourse as $aksesCourse) {

        //     $courses[] = $aksesCourse->course->id;
        // $countAksesMaterial = count($aksesCourse->detail_akses_course);
        // $detailAksesCourse[] = $aksesCourse->detail_akses_course;

        // $persentase = $countAksesMaterial / $aksesCourse->course->getAllMaterial() * 100;
        // $progress[$aksesCourse->course->id] = number_format($persentase, 0, '.', '');

        //     $examScore[$aksesCourse->course->id] = $aksesCourse->score;
        //     $sumScore[$aksesCourse->course->id] = $aksesCourse->getSumScore();
        // }
        $active = 'progress';
        // $persentase_nilai = 0;
        // $courses = count($courses);
        return view('pages.Dashboard.member.progress.index', compact('aksesCourse', 'active', 'progress'));
        // return view('pages.Dashboard.member.progress.index', compact('aksesCourse', 'active', 'progress', 'sumScore', 'examScore', 'courses'));

        // $progress = $aksesCourse;
        // dd($sumScore);
        // // user yang sedang login
        // $akses = Auth::user()->user_role_id;
        // // ambil data akses course yang diakses oleh user Auth
        // $aksesCourse = akses_course::where('user_id', '=', Auth::user()->id)->get();
        // $id_course = [];
        // foreach ($aksesCourse as $key => $value) {
        //     $id_course[] = $value->course_id;
        // }
        // $akses_id = [];
        // foreach ($aksesCourse as $key => $value) {
        //     $akses_id[] = $value->id;
        // }

        // // ambl data course yang menjadi akses dari useer Auth
        // $course = course::whereIn('id', $id_course)->get();
        $active = 'progress';
        // $courses = count($course);

        // // chapter in all
        // $chapter = CourseLesson::whereIn('course_id', $id_course)->get();
        // $id_chapter = [];
        // foreach ($chapter as $key => $value) {
        //     $id_chapter[] = $value->id;
        // }
        // $materi = CourseMaterial::whereIn('course_lesson_id', $id_chapter)->get();

        // $progress = detailAksesCourse::whereIn('akses_course_id', $akses_id)->get();

        // $persentase = $progress->count() / $materi->count() * 100;
        //     $persentase = 7 / 18 * 100;
        // $persen = number_format($persentase, 0, '.', '');
        // $persen = 0;
        // // jumlah nilai member
        // $nilai = nilai::whereIn('akses_course_id', $akses_id)->get();
        // $jumlah = 0;
        // foreach ($nilai as $key => $value) {
        //     $jumlah += $value->score;
        // }

        // jumlah exam yang telah dikerjakan => nilai maksimum yang bisa didapatkan (A)
        // jumlah nilai keseluruhan => jumlah nilai yang anda dapatkan (B)
        // rumus = B / A * 100
        //       = .....%
        // $persentase_nilai = 250 / (4 * 100) * 100;

        // $persentase_nilai = $jumlah / ($nilai->count() * 100) * 100;
        $persentase_nilai = 0;

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
        $aksesCourse = akses_course::findOrFail($id);
        $aksesCourse->load('score', 'course');

        // dd($aksesCourse);


        // $courseUser = course::where('user_id', '=', Auth::user()->id);
        // $course = $courseUser->get();
        // $currentCourse = $courseUser->whereHas('akses_course', function ($q) use ($id) {
        //     $q->where('course_id', $id);
        // })->get();
        $courses = $aksesCourse->count();

        $active = 'progress';
        return view('pages.Dashboard.member.progress.priview', compact(['aksesCourse', 'courses', 'active']));
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
