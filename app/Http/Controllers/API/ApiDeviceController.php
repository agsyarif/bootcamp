<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\data_device;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiDeviceController extends Controller
{
    public function index()
    {
        $token = Str::random(6);

        $dataDevice = data_device::create([
            "token" => $token,
        ]);

        return $dataDevice;
    }
}
