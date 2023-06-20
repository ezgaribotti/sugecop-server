<?php

namespace App\Providers;

use App\Interfaces\Api\OperatorRepositoryInterface;
use App\Interfaces\RepositoryInterface;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
