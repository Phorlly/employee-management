<?php

namespace App\Tables;

use App\Models\Department;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Departments extends AbstractTable
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
        return QueryBuilder::for(Department::class)
            ->defaultSort('id')
            ->allowedSorts(makeSort(new Department()))
            ->allowedFilters(makeFilter(new Department()));
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
            ->column('id', sortable: true)
            ->column('department_name',label: "Department", sortable: true)
            ->column('dept_destription',label: "Description", sortable: true)
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')

            // ->searchInput()
            // ->selectFilter()

            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}