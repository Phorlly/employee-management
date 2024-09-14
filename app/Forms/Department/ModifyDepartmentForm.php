<?php

namespace App\Forms\Department;

use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Textarea;
use ProtoneMedia\Splade\SpladeForm;

class ModifyDepartmentForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form->method('PUT')->class('space-y-4');
    }

    public function fields(): array
    {
        return [
            Text::make('department_name')
                ->label(__('Department'))
                ->rules(['required', 'string', 'max:100']),
            Textarea::make('dept_destription')
                ->rules(['nullable', 'string'])
                ->label('Description'),

            Submit::make()->label(__('Go'))->class('flex justify-end ml-auto rounded-xl'),
        ];
    }
}
