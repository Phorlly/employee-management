<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Users extends AbstractTable
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
        return QueryBuilder::for(User::whereDoesntHave('roles', fn($query) => $query->where('name', 'admin')))
            ->allowedSorts(makeSort(new User()))
            ->allowedFilters(makeFilter(new User()));
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
            ->withGlobalSearch()
            // ->defaultSort('id','desc')
            ->column('id', sortable: true)
            ->column('name', "Full Name", sortable: true)
            ->column('username', sortable: true)
            ->column('gender', sortable: true)
            ->column('email', sortable: true)
            ->column('roles.name', 'Roles', sortable: true)
            ->column('permissions.name', 'Permissions', sortable: true)
            ->column('phone_number', sortable: true, hidden: true)
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')

            // ->searchInput()
            // ->selectFilter()

            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}
