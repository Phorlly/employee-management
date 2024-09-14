<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\NewUserRequest;
use App\Http\Requests\User\OldUserRequest;
use App\Models\User;
use App\Tables\Users;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.all', ['users' => Users::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.new', [
            'data' => sex(),
            'roles' => Role::orderBy('id')->pluck('name', 'id')->toArray(),
            'permissions' => Permission::orderBy('id')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            $roles = Role::whereIn('id', $request->roles)->get();
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $user->syncRoles($roles);
            $user->syncPermissions($permissions);

            return whenComplete(message: 'Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     return view('admin.users.one', compact('user'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.one', [
            'user' => $user,
            'roles' => Role::orderBy('id')->pluck('name', 'id')->toArray(),
            'permissions' => Permission::orderBy('id')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OldUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());
            $roles = Role::whereIn('id', $request->roles)->get();
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $user->syncRoles($roles);
            $user->syncPermissions($permissions);

            return whenSuccess(message: 'Modified', route: 'admin.users.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return whenComplete(message: "Removed");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
