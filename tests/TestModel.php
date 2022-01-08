<?php

namespace mmerlijn\laravelHelpers\tests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mmerlijn\laravelHelpers\Casts\Initials;
use mmerlijn\laravelHelpers\Casts\Phone;

class TestModel extends Model
{
    use HasFactory;

    protected $table = "tests";
    protected $casts = [
        'initials' => Initials::class,
        'phone' => Phone::class,
    ];

    protected static function newFactory()
    {
        return TestModelFactory::new();
    }
}