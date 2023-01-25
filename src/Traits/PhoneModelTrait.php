<?php

namespace mmerlijn\laravelHelpers\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use mmerlijn\msgRepo\Address;
use mmerlijn\msgRepo\Phone;

trait PhoneModelTrait
{

    protected function phone(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => new Phone(
                number: $attributes['phone'] ?? ''
            ),
            set: fn(Phone $phone) => [
                'phone' => $phone->number ?: null,
            ],
        );
    }
}