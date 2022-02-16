<?php

namespace mmerlijn\laravelHelpers\tests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mmerlijn\laravelHelpers\Casts\Phone;
use mmerlijn\laravelHelpers\Traits\AddressModelTrait;
use mmerlijn\laravelHelpers\Traits\NameModelTrait;
use mmerlijn\msgRepo\Enums\PatientSexEnum;


class TestModel extends Model
{
    use HasFactory, AddressModelTrait, NameModelTrait;

    protected $table = "tests";
    protected $casts = [
        'phone' => Phone::class,
        'sex' => PatientSexEnum::class,
    ];

    protected static function newFactory()
    {
        return TestModelFactory::new();
    }
}