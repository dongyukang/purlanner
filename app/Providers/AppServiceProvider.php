<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Blade::if('typeExists', function () {
        return collect(auth()->user()->getNoneZeroTypes())->count() > 0;
      });

      Blade::if('today', function ($due_date) {
        date_default_timezone_set("America/New_York");

        return Carbon::today() == Carbon::parse($due_date);
      });

      Blade::if('tomorrow', function ($due_date) {
        date_default_timezone_set("America/New_York");

        return Carbon::tomorrow() == Carbon::parse($due_date);
      });

      Blade::if('todoExists', function () {
        return true;
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
