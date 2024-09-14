<?php

namespace App\Forms\State;

use App\Models\Country;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class MakeStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->method('POST')
            ->class('space-y-4');
    }

    public function fields(): array
    {
        return [
            Text::make('state_name')->label(__('State'))
                ->rules(['required', 'string', 'max:60', 'min:3']),
            Select::make('country_id')
                ->label('Country')
                ->placeholder('Select a City')
                ->options(Country::pluck('country_name', 'id')->toArray())
                ->rules(['required', 'integer', 'max:60']),

            Submit::make()->label(__('Go'))
                ->class('flex justify-end ml-auto rounded-xl'),
        ];
    }
}
