<?php

namespace App\Tables;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Cities extends AbstractTable
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
        return QueryBuilder::for(City::class)
            ->defaultSort('id')
            ->allowedSorts(makeSort(new City()))
            ->allowedFilters(['state_id', makeFilter(new City())]);
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
            ->column('city_name','City', sortable: true)
            ->column('state.state_name','State')
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')

            // ->searchInput()
            ->selectFilter(
                key: 'state_id',
                options: State::pluck('state_name', 'id')->toArray(),
                label: "State",
                noFilterOptionLabel: 'Select a State'
            )

            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}
