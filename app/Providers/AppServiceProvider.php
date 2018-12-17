<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        // laravel model json storage
// https://github.com/Okipa/laravel-model-json-storage
        //$this->app->register(\Okipa\LaravelModelJsonStorage\ModelJsonStorageServiceProvider::class);
    }

}
