<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\PropertyCreated;
use App\Listeners\SendPropertyCreatedEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PropertyCreated::class => [
            SendPropertyCreatedEmail::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ]; 
}