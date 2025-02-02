<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use illuminate\Support\Str;

class exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function courseLesson()
    {
        return $this->belongsTo(CourseLesson::class);
    }

    public function questions()
    {
        return $this->hasMany(question::class);
    }

    public function getExplanationByQuestionId($questionId)
    {
        return $this->questions()->where('id', $questionId)->value('explanations');
    }

    public function getQuestionByQuestionId($questionId)
    {
        return $this->questions()->where('id', $questionId)->value('title');
    }

    public function getTitleLimit()
    {
        $title = $this->attributes['title'];
        return Str::limit($title, 12);
    }
}
