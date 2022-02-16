<?php

namespace mmerlijn\laravelHelpers\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use mmerlijn\msgRepo\Enums\PatientSexEnum;
use mmerlijn\msgRepo\Name;

trait NameModelTrait
{
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => new Name(
                initials: $attributes['initials'] ?? "",
                lastname: $attributes['lastname'] ?? "",
                prefix: $attributes['prefix'] ?? "",
                own_lastname: $attributes['own_lastname'],
                own_prefix: $attributes['own_lastname'],
                sex: PatientSexEnum::set($attributes['sex'] ?? "")
            ),
            set: fn(Name $name) => [
                'initials' => $name->getInitialsForStorage(),
                'lastname' => $name->lastname,
                'prefix' => $name->prefix,
                'own_lastname' => $name->own_lastname,
                'own_prefix' => $name->own_prefix,
                'sex' => $name->sex->value,
            ],
        );
    }
}