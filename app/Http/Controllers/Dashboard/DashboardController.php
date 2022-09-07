<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\exam;
use App\Models\User;
use App\Models\Order;
use App\Models\course;
use App\Models\comment;

use App\Models\akses_course;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Models\checkout_course;
use App\Models\detailAksesCourse;
use App\Http\Controllers\Controller;
use App\Models\CourseLesson;
use Illuminate\Support\Facades\Auth;
// use Auth;


class DashboardController extends Controller
{

    public function __cunsruct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // return $user->user_role_id;
        // return "dashboard";
        $orders = Order::all();
        // $users = User::all();
        $allMentor = User::where('user_role_id', '=', 2)->count();
        $allMember = User::all()->where('user_role_id', '=', '3')->count();
        // $allUser = User::all()->count();
        $allCourse = course::all()->count();
        $allOrder = Order::all()->count();
        // $courses = course::where('user_id', '=', Auth::user()->id)->get();
        $active = 'home';
        $exam = exam::all();
        // $courses = $course;

        if (Auth::user()->user_roles->name == 'Admin') {

            $courses = course::all()->count();
            $transaksi = checkout_course::where('created_at', '>=', date('Y-m-d', strtotime('-1 month')))->orderBy('created_at', 'desc')->get();
            // mengambil data dari table course berdasarkan 1 bulan terakhir
            $course = course::where('created_at', '>=', date('Y-m-d', strtotime('-1 month')))->orderBy('created_at', 'desc')->get();

            return view('pages.Dashboard.index', compact('transaksi', 'courses', 'allMentor', 'allMember', 'allCourse', 'allOrder', 'active', 'course'));
        } else if (Auth::user()->user_roles->name == 'Mentor') {

            $cc = course::where('user_id', '=', Auth::user()->id)->get();
            $id_cc = [];
            foreach ($cc as $key => $value) {
                $id_cc[] = $value->id;
            }
            $aksesCourse = akses_course::whereIn('course_id', $id_cc)->get();
            $courses = course::where('user_id', '=', Auth::user()->id)->get()->count();

            $comment = comment::whereIn('course_id', $id_cc)->get();

            return view('pages.Dashboard.index', compact('orders', 'courses', 'allMentor', 'allMember', 'allCourse', 'allOrder', 'active', 'exam', 'aksesCourse', 'comment', 'cc'));
        } else if (Auth::user()->user_role_id == '3') {
            // ambil data yang dimiliki user
            $aksesCourse = akses_course::where('user_id', '=', Auth::user()->id)->get();
            $id_course = [];
            $akses_id = [];
            foreach ($aksesCourse as $key => $value) {
                $id_course[] = $value->course_id;
                $akses_id[] = $value->id;
            }
            $course = course::whereIn('id', $id_course)->get();
            $courses = $course->count();

            $transaksi = checkout_course::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

            $chapter = CourseLesson::whereIn('course_id', $id_course)->get();
            $id_chapter = [];
            foreach ($chapter as $key => $value) {
                $id_chapter[] = $value->id;
            }

            $materi = CourseMaterial::whereIn('course_lesson_id', $id_chapter)->get();
            $progress = detailAksesCourse::whereIn('akses_course_id', $akses_id)->get();
            $persentase = $progress->count() / $materi->count() * 100;

            $persen = number_format($persentase, 0, '.', '');


            return view('pages.Dashboard.index', compact('orders', 'courses', 'allMentor', 'allMember', 'allCourse', 'allOrder', 'transaksi', 'active', 'aksesCourse', 'persen', 'progress', 'course', 'materi'));
        }
        // return view('pages.dashboard.admin.index', compact('orders', 'courses', 'allMentor', 'allMember', 'allCourse', 'allOrder', 'active', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
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
        return request()->segments();
        $transaction = checkout_course::find($id);
        $transaction->delete();
        // jika asal dari halaman dashboard maka redirect ke halaman dashboard
        if (request()->segment(2) == 'dashboard') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.transaction.index');
        }
    }
}
