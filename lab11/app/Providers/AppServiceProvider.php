<?php

namespace App\Providers;
use App\Models\Slider;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $slider = Slider::orderby('slider_id','desc')->get();
            $view->with('slider', $slider);
        });
    }
}
