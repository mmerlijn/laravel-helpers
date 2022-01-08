<?php

namespace mmerlijn\laravelHelpers\tests;

use Illuminate\Support\Str;

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
            'initials' => Str::random(2),
        ];
    }
}