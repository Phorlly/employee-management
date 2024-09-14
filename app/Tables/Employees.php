<?php

namespace App\Tables;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Employees extends AbstractTable
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
        return QueryBuilder::for(Employee::class)
            ->defaultSort('id')
            ->allowedSorts(makeSort(new Employee()))
            ->allowedFilters(makeFilter(new Employee()));
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
            ->column('first_name', sortable: true)
            ->column('last_name', sortable: true)
            ->column('middle_name', sortable: true, hidden: true)
            ->column('city.city_name', 'City')
            ->column('department.department_name', 'Department')
            ->column('date_of_birth', sortable: true, hidden: true)
            ->column('date_hired', sortable: true, hidden: true)
            ->column('zip_code', 'Zip Code', hidden: true)
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')
            // ->searchInput()
            ->selectFilter(key: 'country_id',
                label: 'Country',
                options: Country::pluck('country_name', 'id')->toArray(),
                noFilterOptionLabel: "Select a country"
            )
            ->selectFilter(key: 'state_id',
                label: 'State',
                options: State::pluck('state_name', 'id')->toArray(),
                noFilterOptionLabel: "Select a state"
            )
            ->selectFilter(key: 'city_id',
                label: 'city',
                options: City::pluck('city_name', 'id')->toArray(),
                noFilterOptionLabel: "Select a city"
            )
            ->selectFilter(key: 'department_id',
                label: 'Department',
                options: Department::pluck('department_name', 'id')->toArray(),
                noFilterOptionLabel: "Select a department"
            )

            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}
