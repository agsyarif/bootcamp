<?php

namespace App\Http\Controllers\Dashboard\mentor;

use App\Models\course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Http\Controllers\Controller;
use App\Models\exam;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class lessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = course::all();
        $meteri = CourseMaterial::all();
        $chapter = CourseLesson::all();

        $data = [
            'courses' => $courses,
            'meteri' => $meteri,
            'chapter' => $chapter
        ];
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $courseId = request();
        // return $id;
        $courses = course::all();
        $courseId = request()->id;
        return $courses;
        $chapter = CourseLesson::all();
        // return view('pages.Dashboard.mentor.chapter.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "data";
        $title = $request->title;
        // return $title;
        $chapter = CourseLesson::where('id', $request->chapter_id)->first();
        $courseId = $chapter->course_id;
        $videos = $request->file('video');

        $dataVideo = [];

        foreach ($videos as $video) {
            $namaVideo = time() . '.' . $video->getClientOriginalExtension();
            $dataVideo[] = $namaVideo;

            $video->storeAs('course/video', $namaVideo);
        }

        // return $dataVideo;
        $data = [
            'course_lesson_id' => $chapter->id,
            'title' => $title,
            'video' => $dataVideo,
        ];
        // return $data;

        for ($i = 0; $i < count($title); $i++) {

            $materii = new CourseMaterial;
            $materii->course_lesson_id = $data['course_lesson_id'];
            $materii->title = $data['title'][$i];
            $materii->video_url = $data['video'][$i];
            $materii->save();
        }
        // return "berhasil";
        toast('berhasil manambahkan data', 'success');
        return redirect()->route('materi.show', $courseId);
        // return $dataVideo;
        // return "lesson";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = exam::all();
        $course = course::find($id);
        $courses = course::all()->count();
        $chapter = CourseLesson::where('course_id', '=', $id)->get();
        if ($chapter == null) {
            $materi = "";
        } else {
            $materi = CourseMaterial::all();
        }

        return view('pages.Dashboard.mentor.materi.show', compact('course', 'courses', 'chapter', 'materi', 'exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materi = CourseMaterial::find($id);
        $exam = exam::all();
        // return $materi->video_url;
        $chapter = CourseLesson::where('id', '=', $materi->course_lesson_id)->first();
        $courseId = $chapter->course_id;
        $chapterAll = CourseLesson::all();
        $course = course::all();
        $courses = $course->count();
        return view('pages.Dashboard.mentor.materi.edit', compact('materi', 'chapter', 'courseId', 'chapterAll', 'courses', 'course', 'exam'));

        // return $chapter;
        // $materi = CourseMaterial::Where('course_lesson_id', '=', $chapter->id)->get();
        // return view('pages.Dashboard.mentor.materi.create', compact('courses', 'chapter'));
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
        $newMateri = $request;

        $oldMateri = courseMaterial::where('id', $id)->first();
        $oldVideo = $oldMateri->video_url;
        $video = $request->file('video');
        $video_url = "";

        if (!$video) {
            $video_url = $oldVideo;
        } else {
            $video_url = time() . '.' . $video->getClientOriginalExtension();

            Storage::disk('hosting')->delete('course/video/' . $oldVideo);
            $video->storeAs('course/video', $video_url);
        }

        $materi = CourseMaterial::where('id', $id)->first();
        $materi->title = $newMateri->title;
        $materi->video_url = $video_url;
        $materi->save();

        $chapterId = $materi->course_lesson_id;
        $courseId = CourseLesson::where('id', $chapterId)->first()->course_id;

        toast('berhasil mengubah data', 'success');
        return redirect()->route('materi.show', $courseId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materi = CourseMaterial::find($id);
        $chapterId = $materi->course_lesson_id;
        $courseId = CourseLesson::where('id', $chapterId)->first()->course_id;
        $video = $materi->video_url;
        Storage::disk('hosting')->delete('course/video/' . $video);
        $materi->delete();

        toast('berhasil menghapus data', 'success');
        return redirect()->route('materi.show', $courseId);

        // return $id;
    }

    /**
     * add the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        return $id;
        $courses = course::find($id);
        $chapter = CourseLesson::where('course_id', '=', $id)->get();
        return $courses;
        return view('pages.Dashboard.mentor.chapter.add', compact('courses', 'chapter'));
    }
}
