<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        SpladeTable::defaultSearchDebounce(750);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SpladeTable::defaultSearchDebounce(750);
        Gate::before(function ($user, $ability) {
            return $user->hasTokenPermission($ability) ?: null;
        });
    }
}
