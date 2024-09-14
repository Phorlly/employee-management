<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Tables\Cities;
use Illuminate\Http\Request;
use App\Forms\City\MakeCityForm;
use App\Forms\City\ModifyCityForm;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.all', ['cities' => Cities::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.new', [
            // 'states' => State::pluck('state_name', 'id'),
            'form' => MakeCityForm::class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MakeCityForm $form)
    {
        try {
            City::create($form->validate($request));

            return whenComplete(message: 'Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(City $city)
    // {
    //     return view('admin.cities.one', [
    //         'states' => State::pluck('state_name', 'id'),
    //         'city' => $city,
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.cities.one', [
            // 'states' => State::pluck('state_name', 'id'),
            // 'city' => $city,
            'form' => ModifyCityForm::make()
                ->action(route('admin.cities.update', $city))
                ->fill($city),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city, ModifyCityForm $form)
    {
        try {
            $city->update($form->validate($request));

            return whenSuccess(message: 'Modified', route: 'admin.cities.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        try {
            $city->delete();

            return whenComplete(message: "Removed");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
