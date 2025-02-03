<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\akses_course;
use App\Models\CourseCategory;
use App\Models\exam;
use App\Models\level;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

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

        $authRoles = auth()->user()->roles->pluck('name')->first();
        if ($authRoles == 'Mentor' || $authRoles == 'Admin') {
            $courses = course::with('aksesCourse');
            if($authRoles == 'Mentor') {
                $courses->where('user_id', '=', $userId);
            }
            $courses = $courses->get();
            return view('pages.Dashboard.mentor.course.index', compact('courses'));
        } else if ('Member' == $authRoles) {

            $active = 'course';
            $courses = akses_course::where('user_id', $userId)
                ->with(['course.user.user_roles', 'course.level', 'user'])
                ->get();

            return view('pages.Dashboard.member.course.index', compact('courses', 'active'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mentor

        $exam = exam::all();
        $categories_id = course::all()->where('user_id', '=', Auth::user()->id)->pluck('category_id');
        $course = course::where('user_id', '=', Auth::user()->id)->get();
        $courses = $course->count();
        $categories = CourseCategory::all();
        $level = level::all();
        return view('pages.Dashboard.mentor.course.create', compact('categories', 'courses', 'level', 'exam', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'course_level' => 'required'
        ]);

        $dataImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $dataImage = time() . '.' . $image->extension();
            $image->storeAs('course/thumbnail', $dataImage, 'public');
        }

        $user = Auth()->user()->id;
        $course = course::create([
            'user_id' => $user,
            'name' => $request->title,
            'slug' => $request->slug,
            'image' => $dataImage,
            'description' => $request->description,
            'course_category_id' => $request->category_id,
            'level_id' => $request->course_level,
            'price' => $request->price,
        ]);

        toast('berhasil manambahkan data', 'success');
        return redirect()->route('courses.index');
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
        $authRoles = auth()->user()->roles->pluck('name')->first();

        if ($authRoles == 'Mentor' || $authRoles == 'Admin') {
            return view('pages.Dashboard.admin.course.show', compact('course'));
        }elseif ($authRoles == 'Member') {
            $activeMaterial = $course->firstLesson()->firstMaterial();
            return view('pages.Dashboard.member.course.show', compact('course', 'activeMaterial'));
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
        $course = course::where('id', $id)->first();
        $course_category = CourseCategory::all();
        $level = level::all();
        $exam = exam::all();

        $courses = course::all()->count();
        return view('pages.Dashboard.mentor.course.edit', compact('course', 'course_category', 'level', 'exam', 'courses'));
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
        $image = $request->file('thumbnail');
        $firstImg = course::where('id', $id)->first()->image;
        // return $firstImg;

        if ($image == "") {
            $dataImage = $firstImg;
        } else {
            $dataImage = time() . '.' . $image->extension();
            // $image->storeAs('storage/course/thumbnail', $dataImage);
            $path = $image->storeAs('course/thumbnail', $dataImage, 'public');
            // Delete images from public/images/course/thumbnail
            Storage::disk('hosting')->delete('course/thumbnail/' . $firstImg);
            // Storage::delete('images/course/thumbnail/' . $firstImg);
            // $image->storeAs('course/thumbnail', $dataImage);
            // File::delete(public_path('images/course/thumbnail' . $firstImg));
        }

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'image' => $dataImage,
            'description' => $request->description,
            'price' => $request->price,
            'is_publish' => $request->is_publish,
            'course_level' => $request->course_level,
        ];
        // return $request->course_level;
        $course = course::where('id', $id)->first();
        $course->name = $data['title'];
        $course->slug = $data['slug'];
        $course->image = $data['image'];
        $course->description = $data['description'];
        $course->course_category_id = $data['category_id'];
        $course->level_id = $data['course_level'];
        $course->price = $data['price'];
        $course->is_published = $data['is_publish'];
        $course->save();

        toast()->success('Update has been succes');
        return redirect()->route('courses.index');
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
