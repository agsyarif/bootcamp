<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $pass = bcrypt("uwhcamp2022");
        $randomString = Str::random(3);
        $wallet = wallet::firstOrCreate(
            ['wallet_id' => 'ME' . $user->id . "-" . $randomString],
            [
                'name' => $user->name,
                'password' => $pass,
                'saldo' => 0
            ]
        );

        return $wallet;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $pass = bcrypt("uwhcamp2022");
        $randomString = Str::random(3);
        $wallet = wallet::firstOrCreate(
            ['wallet_id' => 'ME' . $user->id . "-" . $randomString],
            [
                'name' => $user->name,
                'password' => $pass,
                'saldo' => 0
            ]
        );
        $mentor = User::where('user_role_id', '=', 2)->get();
        return view('pages.Dashboard.admin.mentor.index', compact('mentor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
