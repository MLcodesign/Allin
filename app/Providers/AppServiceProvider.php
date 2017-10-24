<?php

namespace App\Providers;

use App\Page;
use App\News;
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
        view()->composer('layouts.frontend.includes.header', function ($view) {
            $view->with('pages', Page::published()->page()->get());
        });
		
		
		$news = News::first();
		view()->share('topbarnews', $news);
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
