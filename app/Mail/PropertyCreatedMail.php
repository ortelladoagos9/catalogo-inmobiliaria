<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Property;

class PropertyCreatedMail extends Mailable
{
    public $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function build()
    {
        return $this->subject('Nueva propiedad creada')
                    ->view('emails.property-created');
    }
}