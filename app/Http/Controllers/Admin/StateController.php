<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use App\Tables\States;
use Illuminate\Http\Request;
use App\Forms\State\MakeStateForm;
use App\Forms\State\ModifyStateForm;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.states.all', ['states' => States::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.states.new', [
            // 'countries' => Country::pluck('country_name', 'id'),
            'form' => MakeStateForm::class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MakeStateForm $form)
    {
        try {
            State::create($form->validate($request));

            return whenComplete(message: 'Created');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(State $state)
    // {
    //     return view('admin.states.one');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        return view('admin.states.one', [
            // 'countries' => Country::pluck('country_name', 'id'),
            // 'state' => $state,
            'form' => ModifyStateForm::make()
                ->action(route('admin.states.update', $state))
                ->fill($state),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state, ModifyStateForm $form)
    {
        try {
            $state->update($form->validate($request));

            return whenSuccess(message: 'Modified', route: 'admin.states.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        try {
            $state->delete();

            return whenComplete(message: "Removed");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
