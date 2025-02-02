<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answerUser extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = ['id'];

    public function aksesCourse()
    {
        return $this->belongsTo(akses_course::class);
    }

    public function exam()
    {
        return $this->belongsTo(exam::class);
    }

    public function getAnswerTrue()
    {
        return $this->whereRaw('JSON_CONTAINS(answers, \'{"is_true": 1}\')')->count();
    }

    public function getAnswerFalse()
    {
        return $this->whereRaw('JSON_CONTAINS(answers, \'{"is_true": 0}\')')->count();
    }
}

// [{"questionId":1,"option1":"git","option2":"php","option3":"pemrograman","option4":"robotic","userAnswer":"php","questionAnswer":"git","is_true":0},{"questionId":2,"option1":"sjbnm","option2":"git","option3":"githuub","option4":"gitlab","userAnswer":"git","questionAnswer":"git","is_true":1}]
