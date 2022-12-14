<?php

namespace App\Providers;

use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\UserInterface;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }

    
    public function boot()
    {
        //
    }
}
