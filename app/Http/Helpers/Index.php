<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

// Define a global search filter for your Eloquent model.
function makeQuery($model, $constructor, $option = null)
{
    return QueryBuilder::for($model)
        ->allowedFilters([$option, makeFilter($constructor)])
        ->allowedSorts(makeSort($constructor))
        ->paginate(10)
        ->withQueryString();
}

function makeFilter($model)
{
    $columns = makeSort($model);

    return AllowedFilter::callback('global', function ($query, $value) use ($columns) {
        $query->where(function ($query) use ($value, $columns) {
            Collection::wrap($value)->each(function ($value) use ($query, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$value}%");
                }
            });
        });
    });
}

// Define the columns for sorting your Eloquent model.
function makeSort($model)
{
    return Schema::getColumnListing($model->getTable());
}

function isActive($path, $index = 2)
{
    return Request::segment($index) == $path ? true : false;
}

// Define the functions for displaying toast notifications.
function whenSuccess($message = '', $route = '', $params = '', $duration = 5, $title = 'Message Confirmation')
{
    Toast::title($title)
        ->message($message . ' Successfully..!')
        ->autoDismiss($duration);

    return Redirect::route($route, $params);
}

function whenComplete($message = '', $duration = 5, $title = 'Message Confirmation')
{
    Toast::title($title)
        ->message($message . ' Successfully..!')
        ->autoDismiss($duration);

    return Redirect::back();
}

function hasError($message, $duration = 20, $title = 'Message Confirmation')
{
    Toast::title($title)
        ->message($message->getMessage())
        ->danger()
        ->autoDismiss($duration);

    return Redirect::back();
}

function full($first, $last)
{
    return trim(strtoupper($first) . " " . $last);
}

function username($value)
{
    // Remove any existing '@' symbol and convert to lowercase
    $username = strtolower(ltrim($value, '@_'));

    // Generate a random number between 100 and 999
    $randomNumber = rand(100, 999);

    // Return the formatted username with '@' and random number appended
    return '@' . $username . '_' . $randomNumber;
}

function sex()
{
    return ['gender' => 'female'];
}