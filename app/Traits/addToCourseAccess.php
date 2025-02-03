<?php

namespace App\Traits;

use App\Models\akses_course;
use App\Models\checkout_course;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait addToCourseAccess
{
    public function addToCourseAccess($id)
    {
        $checkout = checkout_course::find($id);
        $add = akses_course::updateOrCreate(['user_id' => $checkout->user_id, 'course_id' => $checkout->course_id], [
            'expired' => date('Y-m-d', strtotime('+1 month'))
        ]);
    }
}

