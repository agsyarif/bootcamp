<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseLesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
    ];

    public function course()
    {
        return $this->belongsTo(course::class);
    }

    public function courseMaterials()
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function firstMaterial()
    {
        return $this->courseMaterials()->first();
    }

    public function latestMaterial()
    {
        return $this->courseMaterials()->orderBy('id', 'desc')->first();
    }

    public function getMatetialAfterThisId($id)
    {
        return $this->courseMaterials()->where('id', '>', $id)->first();
    }

    public function exams()
    {
        return $this->hasMany(exam::class);
    }
}
