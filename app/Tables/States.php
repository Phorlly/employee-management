<?php

namespace App\Tables;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class States extends AbstractTable
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
        return QueryBuilder::for(State::class)
            ->defaultSort('id')
            ->allowedSorts(makeSort(new State()))
            ->allowedFilters(['country_id', makeFilter(new State())]);
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
            ->column('state_name','State', sortable: true)
            ->column('country.country_name', 'Country')
            ->column('actions')

            // ->searchInput()
            ->selectFilter(
                key: 'country_id',
                options: Country::pluck('country_name', 'id')->toArray(),
                label: "Country",
                noFilterOptionLabel: 'Select a Country'
            )

            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}
