<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Tables\Countries;
use ProtoneMedia\Splade\SpladeForm;
use App\Http\Controllers\Controller;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use App\Http\Requests\Country\MakeCountryRequest;
use App\Http\Requests\Country\ModifyCountryRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.countries.all', ['countries' => Countries::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MakeCountryRequest $request)
    {
        try {
            Country::create($request->validated());

            return whenComplete(message: 'Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Country $country)
    // {
    //     return view('admin.countries.one', compact('country'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
            ->action(route('admin.countries.update', $country))
            ->fields([
                Input::make('country_name')->label('Coountry Name'),
                Input::make('country_code')->label('Country Code'),
                Submit::make()->label('Go')->class('mt-4 flex justify-end ml-auto rounded-xl'),
            ])->class('space-y-4')
            ->fill($country)
            ->method("PUT");

        return view('admin.countries.one', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModifyCountryRequest $request, Country $country)
    {
        try {
            $country->update($request->validated());

            return whenSuccess(message: 'Modified', route: 'admin.countries.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            $country->delete();

            return whenComplete(message: "Removed");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
