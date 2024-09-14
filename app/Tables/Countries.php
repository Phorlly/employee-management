<?php

namespace App\Tables;

use App\Models\Country;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Countries extends AbstractTable
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
        return QueryBuilder::for(Country::class)
            // ->defaultSort('id')
            ->allowedSorts(makeSort(new Country()))
            ->allowedFilters(makeFilter(new Country()));
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
            ->column('country_name','Country', sortable: true)
            ->column('country_code',"Code", sortable: true)
            ->column('created_at', sortable: true, hidden: true)
            ->column('actions')

            // ->searchInput()
            // ->selectFilter()

            // ->bulkAction()
            ->export()
            ->paginate(15);
    }
}