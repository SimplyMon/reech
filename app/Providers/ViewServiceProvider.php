<?php
// app/Providers/ViewServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot(): void
    {

        View::composer('*', function ($view) {
            $currentUser = Auth::user();
            if ($currentUser) {
                $currentUser->loadMissing('detail');
            }
            $view->with('currentUser', $currentUser);
        });
    }
}
