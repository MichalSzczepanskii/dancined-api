<?php

namespace App\Providers;

use App\Interfaces\ClientRepository;
use App\Interfaces\ParticipantRepository;
use App\Repositories\EloquentClientRepository;
use App\Repositories\EloquentParticipantRepository;
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
        $this->app->bind(
            ParticipantRepository::class,
            EloquentParticipantRepository::class
        );
        $this->app->bind(
            ClientRepository::class,
            EloquentClientRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
