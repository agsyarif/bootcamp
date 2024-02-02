<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Dashboard\commentController;
use App\Http\Controllers\Dashboard\CourseController as DashboardCourseController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\WebinarController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\member\QuizController;
use App\Http\Controllers\Dashboard\mentor\ExamController;
use App\Http\Controllers\Dashboard\mentor\TypeController;
use App\Http\Controllers\Dashboard\member\MateriController;
use App\Http\Controllers\Dashboard\mentor\courseController;
// use App\Http\Controllers\Dashboard\mentor\profileController as mentorProfileController;
use App\Http\Controllers\Dashboard\mentor\lessonController;
use App\Http\Controllers\Dashboard\mentor\chapterController;
use App\Http\Controllers\Dashboard\mentor\priviewController;
use App\Http\Controllers\Dashboard\member\ProgressController;
use App\Http\Controllers\Dashboard\mentor\QuestionController;
use App\Http\Controllers\Dashboard\mentor\createMateriController;
use App\Http\Controllers\Dashboard\mentor\courseCategoryController;
use App\Http\Controllers\Dashboard\MentorController as DashboardMentorController;
use App\Http\Controllers\Dashboard\member\CourseController as MemberCourseController;
use App\Http\Controllers\Dashboard\member\MemberController as MemberMemberController;
use App\Http\Controllers\Dashboard\mentor\ExamAnswerController;
use App\Http\Controllers\Dashboard\mentor\ExamScoreController;
use App\Http\Controllers\Dashboard\mentor\MemberController as MentorMemberController;
use App\Http\Controllers\Dashboard\mentor\profileController as mentorProfileController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Permission\AssignPermissionController;
use App\Http\Controllers\Permission\permissionController;
use App\Http\Controllers\WalletController;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

// frontend

// dashboard (member)
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cekredis', function () {
    $p = Redis::incr('p');
    return $p;
});

Route::get('test-roles', function () {
    return Auth::user()->roles;
});

Route::get('wallet', [WalletController::class, 'index']);

Route::get('corporate', [LandingController::class, 'corporate'])->name('corporate.landing');
Route::get('profesional', [LandingController::class, 'profesional'])->name('profesional.landing');
Route::get('detail_booking/{slug:created_at}', [LandingController::class, 'detail_booking'])->name('detail.booking.landing');
Route::get('booking/{id}', [LandingController::class, 'booking'])->name('booking.landing');
Route::get('detail/{slug:slug}', [LandingController::class, 'detail'])->name('detail.landing');
Route::get('explore', [LandingController::class, 'explore'])->name('explore.landing');
Route::get('About', [LandingController::class, 'about'])->name('about');
// Route::get('midtrans/success', MidtransController::class, 'success');
// Route::get('midtrans/unfinish', MidtransController::class, 'unfinish');
// Route::get('midtrans/error', MidtransController::class, 'error');
Route::resource('/', LandingController::class);


// midtrans route
Route::post('payment/success', [LandingController::class, 'midtransCallback']);
Route::get('payment/success', [LandingController::class, 'midtransCallback']);


// Route::get('chatify', [MessagesController::class, 'index']);
Route::get('chatify', [MessagesController::class, 'index'])->name(config('chatify.path'));
// Route::post('checkout', [CheckoutController::class, 'proccess'])->name('checkout');
// Route::post('success', [CheckoutController::class, 'callback'])->name('midtrans.callback');
// Dashboard
// route group menggunakan middleware admin
// Route::group(['middleware' => ['auth', 'admin']], function () {
// Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// })

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('dashboard', DashboardController::class)->middleware('permission:dashboard');
    Route::resource('member-management', MemberController::class)->middleware('permission:member-management');
    Route::resource('mentor-management', DashboardMentorController::class)->middleware('permission:mentor-management');
    Route::resource('transaction', TransactionController::class)->middleware('permission:transaction');
    Route::resource('courses', DashboardCourseController::class)->middleware('permission:course');
    Route::resource('comment', commentController::class)->middleware('permission:comment');
    Route::resource('webinar', WebinarController::class)->middleware('permission:webinar');
    Route::post('wallet/{user}', [WalletController::class, 'create'])->name('create-wallet')->middleware('permission:create-wallet');
    Route::resource('permission', permissionController::class)->middleware('permission:permission');
    Route::resource('role', AssignPermissionController::class)->middleware('permission:role-management');

    Route::resource('categories', courseCategoryController::class);
    Route::resource('course/member', MentorMemberController::class);
    Route::resource('course/member/exam-score', ExamScoreController::class)->only('show');
    Route::resource('course/member/exam-score/exam-answer', ExamAnswerController::class)->only('show');
    Route::resource('materi', lessonController::class);
    Route::resource('chapter', chapterController::class);
    Route::get('chapter-quiz/{chapterId}', [chapterController::class, 'addQuiz'])->name('chapter-quiz');
    Route::resource('create-materi', createMateriController::class);
    Route::resource('priview', priviewController::class);
    Route::resource('exam', ExamController::class);
    Route::resource('type', TypeController::class);
    Route::resource('question', QuestionController::class)->except('create');
});

// Route::group(
//     ['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'verified', 'role:Admin']],
//     function () {

//         Route::resource('dashboard', DashboardController::class);
//         Route::resource('member-management', MemberController::class);
//         Route::resource('mentor-management', DashboardMentorController::class);
//         Route::resource('transaction', TransactionController::class);
//         Route::resource('course', DashboardCourseController::class);
//         Route::resource('comment', commentController::class);
//         Route::resource('webinar', WebinarController::class);
//         Route::resource('profile', ProfileController::class);
//         // Route::resource('user', UserController::class);
//         Route::post('wallet/{user}', [WalletController::class, 'create'])->name('create-wallet');
//         // Route::resource('wallet', WalletController::class);

//         Route::resource('permission', permissionController::class)->except('show');
//         Route::resource('role', AssignPermissionController::class);
//     }
// );

// Route::group(
//     ['prefix' => 'mentor', 'as' => 'mentor.', 'middleware' => ['auth', 'verified', 'role:Mentor']],
//     function () {

//         Route::resource('dashboard', DashboardController::class);
//         Route::resource('course', courseController::class);
//         Route::resource('materi', lessonController::class);
//         Route::resource('chapter', chapterController::class);
//         Route::resource('create-materi', createMateriController::class);
//         Route::resource('profile', mentorProfileController::class);
//         Route::resource('categories', courseCategoryController::class);
//         Route::resource('priview', priviewController::class);
//         Route::resource('exam', ExamController::class);
//         Route::resource('type', TypeController::class);
//         Route::resource('question', QuestionController::class)->except('create');
//         // Route::get('question-create/{courseId}/{examId}', [QuestionController::class, 'create']);
//         Route::resource('course/member', MentorMemberController::class);
//         Route::resource('course/member/exam-score', ExamScoreController::class)->only('show');
//         Route::resource('course/member/exam-score/exam-answer', ExamAnswerController::class)->only('show');
//     }
// );

// Route::group(
//     ['prefix' => 'member', 'as' => 'member.', 'middleware' => ['auth', 'verified', 'Member']],
//     function () {
//         Route::resource('dashboard', DashboardController::class);
//         Route::resource('course', MemberCourseController::class);
//         Route::get('course-redis', [MemberCourseController::class, 'indexRedis']);
//         Route::get('materi/{id}/', [MateriController::class, 'tampil'])->name(name: 'course.materi');
//         Route::resource('progress', ProgressController::class);
//         Route::resource('comment', commentController::class);
//         // quiz

//         Route::get('quiz/{id}/', [QuizController::class, 'start'])->name('course.quiz');
//         Route::get('quiz/result/{score}/{id}', [QuizController::class, 'result'])->name('quiz.result');
//         // Route::resource('materi', MateriController::class);
//     }
// );

Route::resource('permission/assign', AssignPermissionController::class);

// route socialite
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
