<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\data_device;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiDeviceController extends Controller
{
    public function index(Request $request)
    {
        $uuid = $request->uuid;
        $email = $request->email;
        $token = Str::random(6);

        $dataDevice = data_device::create([
            "token" => $token,
            "uuid" => $uuid,
            "email" => $email
        ]);

        return $dataDevice;
    }

    public function activate(Request $request)
    {
        $token = $request->token;
        $uuid = $request->uuid;
        $dataDevice = data_device::where('token', $token)->get()->first();

        if ($dataDevice == null) {
            return response()->json([
                'error' => 'token tidak valid'
            ], 400);
        } elseif ($dataDevice->uuid != null && $dataDevice->uuid != $uuid) {
            return response()->json([
                'error' => 'token sudah digunakan'
            ], 400);
        }

        data_device::where('token', $token)->update([
            'uuid' => $uuid,
            'active' => 1
        ]);

        return response()->json([
            'success' => 'aktifasi berhasil'
        ], 200);
    }
}
