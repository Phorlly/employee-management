<?php

namespace App\Http\Controllers\Admin;

use App\Forms\Employee\MakeEmployeeForm;
use App\Forms\Employee\ModifyEmployeeForm;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Employee;
use App\Tables\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employees.all', ['employees' => Employees::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.new', [
            'form' => MakeEmployeeForm::class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MakeEmployeeForm $form)
    {
        try {
            $data = $form->validate($request);
            $city = City::findOrFail($request->city_id);
            $data['first_name'] = strtoupper($request->first_name);
            Employee::create(array_merge($data, [
                'country_id' => $city->state->country_id,
                'state_id' => $city->state_id,
            ]));

            return whenComplete(message: 'Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Display the specified resource.
     */
    // public function show(Employee $employee)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.one', [
            'form' => ModifyEmployeeForm::make()
                ->action(route('admin.employees.update', $employee))
                ->fill($employee),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, ModifyEmployeeForm $form)
    {
        try {
            $data = $form->validate($request);
            $city = City::findOrFail($request->city_id);
            $data['first_name'] = strtoupper($request->first_name);
            $employee->update(array_merge($data, [
                'country_id' => $city->state->country_id,
                'state_id' => $city->state_id,
            ]));

            return whenSuccess('Modified', 'admin.employees.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return whenComplete('Removed');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
