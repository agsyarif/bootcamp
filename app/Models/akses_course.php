<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class akses_course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(course::class);
    }

    public function detail_akses_course()
    {
        return $this->hasMany(detailAksesCourse::class);
    }

    public function score()
    {
        return $this->hasMany(answerUser::class);
    }

    public function getCountExam()
    {
        return $this->score()
            ->get()
            ->count();
    }

    public function getSumScore()
    {
        return $this->score()
            ->get()
            ->sum(function ($score) {
                return $score->score;
            });
        // ->sum('score');
    }

    public function examScore()
    {
        return $this->hasMany(nilai::class);
    }

    public function getDetailByMaterial($id)
    {
        return $this->detail_akses_course()->where('course_material_id', $id)->first();
    }
}
