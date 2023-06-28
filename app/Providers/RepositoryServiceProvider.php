<?php

namespace App\Providers;

use App\Interfaces\Api\AddressRepositoryInterface;
use App\Interfaces\Api\CustomerRepositoryInterface;
use App\Interfaces\Api\GenderRepositoryInterface;
use App\Interfaces\Api\IdentificationRepositoryInterface;
use App\Interfaces\Api\IdentificationTypeRepositoryInterface;
use App\Interfaces\Api\OperatorRepositoryInterface;
use App\Interfaces\RepositoryInterface;
use App\Repositories\Api\AddressRepository;
use App\Repositories\Api\CustomerRepository;
use App\Repositories\Api\GenderRepository;
use App\Repositories\Api\IdentificationRepository;
use App\Repositories\Api\IdentificationTypeRepository;
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
        $this->app->bind(IdentificationTypeRepositoryInterface::class, IdentificationTypeRepository::class);
        $this->app->bind(IdentificationRepositoryInterface::class, IdentificationRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
