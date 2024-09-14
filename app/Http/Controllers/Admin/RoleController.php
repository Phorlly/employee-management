<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\NewRoleRequest;
use App\Http\Requests\Role\OldRoleRequest;
use App\Tables\Roles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.all', ['tables' => Roles::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.new', [
            'permissions' => Permission::orderBy('id')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewRoleRequest $request)
    {
        try {
            $role = Role::create($request->validated());
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);

            return whenComplete('Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.one', [
            'permissions' => Permission::orderBy('id')->pluck('name', 'id')->toArray(),
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OldRoleRequest $request, Role $role)
    {
        try {
            $role->update($request->validated());
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);

            return whenSuccess('Modified', 'admin.roles.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return whenComplete('Removed');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
