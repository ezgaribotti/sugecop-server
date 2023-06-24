<?php

namespace App\Providers;

use App\Interfaces\Api\CustomerRepositoryInterface;
use App\Interfaces\Api\GenderRepositoryInterface;
use App\Interfaces\Api\OperatorRepositoryInterface;
use App\Interfaces\RepositoryInterface;
use App\Repositories\Api\CustomerRepository;
use App\Repositories\Api\GenderRepository;
use App\Repositories\Api\OperatorRepository;
use App\Repositories\Repository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(GenderRepositoryInterface::class, GenderRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
