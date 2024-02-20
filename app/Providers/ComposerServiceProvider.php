<?php

namespace App\Providers;

use App\Models\MenusModel;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        view()->composer('components.layouts.app', function ($view) {
            $view->with('menus', MenusModel::with(["childrens"])->where("parent_id",null)->where("is_active","1")->orderBy("order","asc")->get());
        });
    }
}
