<?php

namespace App\Providers;

use App\Blog;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   //here we are sharing this blog data to 2 views --removed
        view::composer(['partials.meta_dynamic','layouts.nav'], function($view) {
          $view->with('blogs', Blog::all());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
