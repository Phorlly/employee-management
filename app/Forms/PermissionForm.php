<?php

namespace App\Forms;

use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class PermissionForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.permissions.store'))
            ->method('POST')
            ->class('space-y-4');
    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->rules(['required', 'max:255', 'string', 'unique:permissions'])
                ->label(__('Name')),

            Submit::make()->label(__('Go'))
                ->class('flex justify-end ml-auto rounded-xl'),
        ];
    }
}
