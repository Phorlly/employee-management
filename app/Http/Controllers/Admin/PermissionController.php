<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\NewPermissionRequest;
use App\Http\Requests\Permission\OldPermissionRequest;
use App\Tables\Permissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.permissions.all', ['tables' => Permissions::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.new', [
            'roles' => Role::orderBy('id')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewPermissionRequest $request)
    {
        try {
            $permission = Permission::create($request->validated());
            $roles = Role::whereIn('id', $request->roles)->get();
            $permission->syncRoles($roles);

            return whenComplete(message: 'Created');
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
    public function edit(Permission $permission)
    {
        return view('admin.permissions.one', [
            'roles' => Role::orderBy('id')->pluck('name', 'id')->toArray(),
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OldPermissionRequest $request, Permission $permission)
    {
        try {
            $permission->update($request->validated());
            $roles = Role::whereIn('id', $request->roles)->get();
            $permission->syncRoles($roles);

            return whenSuccess(message: 'Modified', route: 'admin.permissions.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();

            return whenComplete(message: 'Removed');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
