<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {

        $this->app->bind('App\Repositories\GuestRepositories\GuestTicketRepositoryInterface','App\Repositories\GuestRepositories\GuestTicketRepository');

    }
}