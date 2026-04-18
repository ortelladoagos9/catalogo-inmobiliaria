<?php

namespace App\Listeners;

use App\Events\PropertyCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\PropertyCreatedMail;
use App\Models\User;

class SendPropertyCreatedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PropertyCreated $event)
    {
        $property = $event->property;

        // Obtener usuarios con perfil de admin u operador
        $users = User::whereHas('profile', function ($q) {
            $q->whereIn('description', ['Administrador', 'Operario']);
        })->get();

        // Enviar email a cada usuario
        foreach ($users as $user) {
            Mail::to($user->email)->send(new PropertyCreatedMail($property));
        }
    }
}
