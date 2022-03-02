<?php

namespace mmerlijn\laravelHelpers\tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use mmerlijn\laravelHelpers\tests\TestCase;
use mmerlijn\laravelHelpers\tests\TestModel;

class AddressModelTraitTest extends TestCase
{

    use RefreshDatabase;

    public function test_addressModel_initialisation()
    {
        $p = TestModel::factory()->create();
        $this->assertSame($p->postcode, $p->address->postcode);
        $p->address->building = "54a";
        $p->save();
        $p->refresh();
        $this->assertSame("54", $p->address->building_nr);
        $this->assertSame("a", $p->address->building_addition);
        $this->assertSame("54 a", $p->address->building);
    }

    public function test_has_address_attribute()
    {
        $p = TestModel::factory()->create();
        $address = $p->address;
        $this->assertSame($p->city, $address->city);
        $this->assertSame($p->postcode, $address->postcode);
    }

}