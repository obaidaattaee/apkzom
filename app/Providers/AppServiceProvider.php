<?php

namespace App\Providers;

use App\Models\App;
use App\Models\Category;
use App\Models\OSType;
use App\Models\Tag;
use App\Observers\AppObserver;
use App\Observers\CategoryObserver;
use App\Observers\OSTypeObserver;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use App\User;
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
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Tag::observe(TagObserver::class);
        OSType::observe(OSTypeObserver::class);
        App::observe(AppObserver::class);
    }
}