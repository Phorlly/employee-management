<?php

namespace App\Forms\Employee;

use App\Models\City;
use App\Models\Department;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class ModifyEmployeeForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form->method('PUT')->class('grid grid-cols-1 md:grid-cols-2 gap-4');
    }

    public function fields(): array
    {
        return [
            Text::make('first_name')
                ->rules(['required', 'string', 'min:3', 'max:255'])
                ->label(__('First Name')),
            Text::make('last_name')
                ->rules(['required', 'string', 'min:3', 'max:255'])
                ->label(__('Last Name')),
            Text::make('middle_name')
                ->rules(['nullable', 'string', 'min:2', 'max:255'])
                ->label(__('Middle Name')),
            Text::make('zip_code')
                ->rules(['required', 'string', 'min:5', 'max:255'])
                ->label(__('Zip Code')),
            // Select::make('country_id')
            //     ->label('Country')
            //     ->options(Country::pluck('country_name', 'id')->toArray())
            //     ->rules(['required', 'integer']),
            // Select::make('state_id')
            //     ->label('State')
            //     ->options(State::pluck('state_name', 'id')->toArray())
            //     ->rules(['required', 'integer']),
            Select::make('department_id')
                ->label('Department')
                ->options(Department::pluck('department_name', 'id')->toArray())
                ->rules(['required', 'integer', 'exists:departments,id']),
            Select::make('city_id')
                ->label('City')
                ->options(City::pluck('city_name', 'id')->toArray())
                ->rules(['required', 'integer', 'exists:cities,id']),
            Date::make('date_of_birth')
                ->rules(['required', 'date'])
                ->label(__('Date of Birth')),
            Date::make('date_hired')
                ->rules(['required', 'date'])
                ->label(__('Date Hired')),

            Submit::make()->label(__('Go'))->class('flex justify-end rounded-xl'),
        ];
    }
}
