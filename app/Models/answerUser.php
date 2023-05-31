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
}
