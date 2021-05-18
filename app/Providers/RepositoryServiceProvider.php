<?php

namespace App\Providers;

use App\Api\V1\Repositories\Eloquent\UserEloquentRepository;
use App\Contracts\Repository\IUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Repositories

        $this->app->bind(IUserRepository::class, UserEloquentRepository::class);
    }
}
