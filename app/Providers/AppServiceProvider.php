<?php

namespace App\Providers;

use App\Models\User;
use App\Repositries\AuthRepository;
use App\Repositries\EmployeeRepository;
// use App\Repositries\AuthRepository;
// use App\Repositries\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthRepository::class, function ($app) {
            return new AuthRepository(new User());
        });

        $this->app->bind(EmployeeRepository::class, function ($app) {
            return new EmployeeRepository(new User());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
