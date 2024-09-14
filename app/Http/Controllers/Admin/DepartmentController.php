<?php

namespace App\Http\Controllers\Admin;

use App\Forms\Department\MakeDepartmentForm;
use App\Forms\Department\ModifyDepartmentForm;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Tables\Departments;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.departments.all', ['departments' => Departments::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.new',[
            'form' => MakeDepartmentForm::class
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MakeDepartmentForm $form)
    {
        try {
            Department::create($form->validate($request));

            return whenComplete(message: 'Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Department $department)
    // {
    //     return view('admin.departments.one', compact('department'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.one', [
            // 'department' => $department
            'form' => ModifyDepartmentForm::make()
                ->action(route('admin.departments.update', $department))
                ->fill($department),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department, ModifyDepartmentForm $form)
    {
        try {
            $department->update($form->validate($request));

            return whenSuccess(message: 'Modified', route: 'admin.departments.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();

            return whenComplete(message: "Removed");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
