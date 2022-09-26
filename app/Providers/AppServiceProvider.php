<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Department;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        View::share('setting', Setting::first());
        View::share('cities', District::orderBy("name")->get());
        View::share('departments', Department::latest()->limit(8)->get());
    }
}
