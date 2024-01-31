<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailUser;
use App\Models\UserRole;
use App\Models\wallet;
use App\Services\UserService;
use App\Services\WalletService;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentor = User::role('Mentor')->count();
        return view('pages.Dashboard.admin.mentor.index', compact('mentor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Dashboard.admin.mentor.create', [
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
        $walletService = new WalletService();

        $newUser = $userService->createUser($request);

        $newUser['password_hash'] = $password;
        $walletService->fisrtOrUpdateWallet($newUser);

        toast()->success('Berhasil menambahkan mentor', 'success');
        return redirect()->route('admin.mentor-management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.Dashboard.admin.mentor.show', [
            'mentor' => User::findOrFail($id),
            // 'detail' => DetailUser::where('user_id', '=', $id)->first(),
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
        return view('pages.Dashboard.admin.mentor.edit', [
            'mentor' => User::findOrFail($id),
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
        // $user->assignRole();

        toast()->success('Berhasil mengubah mentor', 'success');
        return redirect()->route('admin.mentor-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'destroy mentor';
        $user = User::findOrFail($id);
        $user->delete();

        toast()->success('Berhasil menghapus mentor', 'success');
        return redirect()->route('admin.mentor-management.index');
    }
}
