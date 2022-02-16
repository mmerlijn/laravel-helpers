<?php

namespace mmerlijn\laravelHelpers\tests;

use Illuminate\Support\Str;
use mmerlijn\msgRepo\Enums\PatientSexEnum;

class TestModelFactory extends \Illuminate\Database\Eloquent\Factories\Factory
{

    protected $model = TestModel::class;

    public function definition()
    {
        $cities = ["Purmerend", "Hoorn", "Zaandam", "Amsterdam", "Uitgeest"];
        $this->faker = \Faker\Factory::create('nl_NL');
        return [
            'city' => $this->faker->randomElement($cities),
            'phone' => $this->faker->phoneNumber,
            'street' => $this->faker->streetName,
            'building' => $this->faker->buildingNumber,
            'postcode' => $this->faker->postcode,
            'own_lastname' => $this->faker->lastName,
            'initials' => strtoupper(Str::random(2)),
            'sex' => PatientSexEnum::set($this->faker->randomElement(['F', "M", "X"])),
        ];
    }
}