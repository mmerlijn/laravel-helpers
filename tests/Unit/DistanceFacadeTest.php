<?php

namespace mmerlijn\laravelHelpers\tests\Unit;

use mmerlijn\laravelHelpers\Enums\DistanceUnits;
use mmerlijn\laravelHelpers\Facades\Distance;
use mmerlijn\laravelHelpers\tests\TestCase;

class DistanceFacadeTest extends TestCase
{
    public function test_city_to_city_distance()
    {
        $d = Distance::from("Purmerend")
            ->to("Ilpendam")
            ->get();
        $this->assertEquals(5.4, $d);
    }

    public function test_city_to_coordinate_distance()
    {
        $d = Distance::from("Purmerend")
            ->to(...[52.46591995, 4.96990604343952])
            ->get();
        $this->assertEquals(5.4, $d);
    }

    public function test_coordinates_to_city_distance()
    {
        $d = Distance::to("Purmerend")
            ->from(...[52.46591995, 4.96990604343952])
            ->get();
        $this->assertEquals(5.4, $d);
    }

    public function test_coor_to_coor_distance()
    {
        $d = Distance::to(...[52.5144, 4.9641])
            ->from(...[52.46591995, 4.96990604343952])
            ->get();
        $this->assertEquals(5.4, $d);

        $d = Distance::to(['lat' => 52.5144, 'long' => 4.9641])
            ->from(['lat' => 52.46591995, 'long' => 4.96990604343952])
            ->get();
        $this->assertEquals(5.4, $d);
    }

    public function test_distance_unit_setter()
    {
        $d = Distance::from("Purmerend")
            ->to("Ilpendam")
            ->get(DistanceUnits::M);
        $this->assertEquals(5405, $d);
    }

    public function test_distance_formatter()
    {
        $d = Distance::from("Purmerend")
            ->to("Ilpendam")
            ->get(format: true);
        $this->assertEquals("5,4km", $d);
    }

    public function test_distance_decimal_setter()
    {
        $d = Distance::from("Purmerend")
            ->to("Ilpendam")
            ->get(format: true, precision: 2);
        $this->assertEquals("5,41km", $d);
    }

    public function test_distance_city_not_exist()
    {
        $this->expectExceptionMessageMatches('/(City)/');
        $d = Distance::from("Paris")
            ->to("Amsterdam")
            ->get();
    }

    public function test_invalid_input()
    {
        $this->expectExceptionMessageMatches('/(From)/');
        $d = Distance::from(54.002)
            ->to("Amsterdam")
            ->get();
    }

    public function test_without_coordinates_input()
    {
        $this->expectExceptionMessageMatches('/(Not all)/');
        $d = Distance::get();
    }
}