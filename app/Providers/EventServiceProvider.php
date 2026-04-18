<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\PropertyCreated;
use App\Listeners\SendPropertyCreatedEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PropertyCreated::class => [
            SendPropertyCreatedEmail::class,
        ],
    ]; 
}