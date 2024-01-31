<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\OrderCourse;
use App\Models\OrderWebinar;
use App\Models\UserRole;
use App\Models\wallet;
use App\Services\UserService;
use App\Services\WalletService;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = User::role('Member')->get();
        $orderC = OrderCourse::all();
        $orderW = OrderWebinar::all();
        return view('pages.Dashboard.admin.member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Dashboard.admin.member.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'nullable|min:6',
            'role' => 'required'
        ]);

        $password = bcrypt($request->password ?? "oncode2023");
        $request['password_hash'] = $password;

        $userService = new UserService();
        $newUser = $userService->createUser($request);

        toast()->success('Berhasil menambahkan member baru', 'Berhasil');
        return redirect()->route('admin.member-management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.Dashboard.admin.member.show', [
            'member' => User::findOrFail($id),
            // 'orderC' => OrderCourse::where('user_id', '=', $id)->get(),
            // 'orderW' => OrderWebinar::where('user_id', '=', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.Dashboard.admin.member.edit', [
            'member' => User::findOrFail($id),
            'roles' => Role::all(),
        ]);
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

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'is_active' => 'required',
        ]);

        $user = User::findOrFail($id);

        $updateUser = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active
        ]);

        $user->syncRoles([$request->role]);

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,' . $id,
        //     'user_role_id' => 'required',
        //     'is_active' => 'required',
        // ]);

        // $user = User::findOrFail($id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->user_role_id = $request->user_role_id;
        // $user->is_active = $request->is_active;
        // $user->save();

        // if ($request->user_role_id == 2) {
        //     $pass = bcrypt("uwhcamp2022");
        //     $randomString = Str::random(3);
        //     $wallet = wallet::firstOrCreate(
        //         ['wallet_id' => 'ME' . $user->id . "-" . $randomString],
        //         [
        //             'name' => $user->name,
        //             'password' => $pass,
        //             'saldo' => 0
        //         ]
        //     );
        // }

        toast()->success('Berhasil mengubah member', 'Berhasil');
        return redirect()->route('admin.member-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        toast()->success('Berhasil menghapus member', 'Berhasil');
        return redirect()->route('admin.member-management.index');
    }
}
