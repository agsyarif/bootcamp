<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function exam()
    {
        return $this->belongsTo(exam::class);
    }

    public function akses_course()
    {
        return $this->belongsTo(akses_course::class);
    }
}
