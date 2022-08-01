<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailAksesCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'akses_course_id',
        'course_material_id'
    ];

    public function akses_course()
    {
        return $this->belongsTo(akses_course::class);
    }

    public function courseMaterial()
    {
        return $this->belongsTo(courseMaterial::class);
    }
}
