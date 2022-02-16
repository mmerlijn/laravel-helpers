<?php

namespace mmerlijn\laravelHelpers\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use mmerlijn\msgRepo\Address;

trait AddressModelTrait
{

    protected function address(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => new Address(
                postcode: $attributes['postcode'] ?? '',
                building: $attributes['building'] ?? '',
                street: $attributes['street'] ?? '',
                city: $attributes['city'] ?? ''),
            set: fn(Address $address) => [
                'street' => $address->street,
                'postcode' => $address->postcode,
                'city' => $address->city,
                'building' => $address->building
            ],
        );
    }
}