<?php

namespace App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\Permission\Models\Permission;

class Permissions extends AbstractTable
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
        // return QueryBuilder::for(Permission::class)
        //     ->defaultSort('id')
        //     ->allowedSorts(makeSort(new Permission()))
        //     ->allowedFilters(makeFilter(new Permission()));
        return Permission::query();
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
            ->defaultSortDesc('id')
            ->withGlobalSearch(columns: ['name', 'roles.name'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('roles.name','Roles', sortable: true)
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')

            // ->searchInput()
            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}
