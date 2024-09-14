<?php

namespace App\Forms\City;

use App\Models\State;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class MakeCityForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.cities.store'))
            ->method('POST')
            ->class('space-y-4');
    }

    public function fields(): array
    {
        return [
            Text::make('city_name')->label(__('City'))
                ->rules(['required', 'string', 'max:60', 'min:3']),
            Select::make('state_id')
                ->label('State')
                ->placeholder('Select a State')
                ->options(State::pluck('state_name', 'id')->toArray())
                ->rules(['required', 'integer', 'max:60']),

            Submit::make()->label(__('Go'))->class('flex justify-end ml-auto rounded-xl'),
        ];
    }
}
