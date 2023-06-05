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

    public function examScore()
    {
        return $this->hasMany(nilai::class);
    }
}
