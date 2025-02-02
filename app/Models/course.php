<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'course_category_id',
        'image',
        'price',
        'description',
        'level_id',
        'is_published',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(level::class);
    }

    public function course_category()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function chapters()
    {
        return $this->hasMany(CourseLesson::class);
    }

    public function course_lessons()
    {
        return $this->hasMany(CourseLesson::class);
    }

    public function getAllMaterial()
    {
        return $this->course_lessons()
            ->withCount('courseMaterials')
            ->get()
            // ->sum(function ($chapter) {
            //     return $chapter->course_materials_count;
            // });
            ->sum('course_materials_count');
    }

    public function checkout_course()
    {
        return $this->hasMany(checkout_course::class);
    }

    public function getCountExams()
    {
        return $this->course_lessons()
            ->withCount('exams')
            ->get()
            ->sum('exams_sum');
    }

    public function searchByColumnName($request)
    {
        return $this->where('name', 'LIKE', '%' . $request . '%')
            ->orWhere('price', 'like', '%' . $request . '%')->get();
    }

    public function aksesCourse()
    {
        return $this->hasMany(akses_course::class);
    }

    public function getAccessCourse()
    {
        // $user
        return $this->aksesCourse()->where('user_id', auth()->user()->id)->first();
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
    }

    public function firstLesson()
    {
        return $this->course_lessons()->first();
    }

    public function latestLesson()
    {
        return $this->course_lessons()->orderBy('id', 'desc')->first();
    }

    public function getChapterAfterThisId($id)
    {
        return $this->course_lessons()->where('id', '>', $id)->first();
    }

    public function getMaterialById($id)
    {
        return CourseMaterial::find($id);
        // return $this->course_lessons()->courseMaterials();
    }

    public function exams()
    {
        return $this->HasManyThrough(exam::class, CourseLesson::class, 'id', 'course_lesson_id', 'course_id', 'id');
    }
}
