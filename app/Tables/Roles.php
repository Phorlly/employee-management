<?php

namespace App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\Permission\Models\Role;

class Roles extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
// return QueryBuilder::for(Role::where('name', '!=', 'superadmin'))
//     ->defaultSort('id')
//     ->allowedSorts(makeSort(new Role()))
//     ->allowedFilters(makeFilter(new Role()));

        return Role::where('name', '!=', 'admin');

    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name', 'permissions.name'])
            ->defaultSortDesc('id')
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('permissions.name', 'Permissions', sortable: true)
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')

            // ->searchInput()
            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}
