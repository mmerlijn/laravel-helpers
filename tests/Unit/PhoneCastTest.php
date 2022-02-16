<?php

namespace mmerlijn\laravelHelpers\tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use mmerlijn\laravelHelpers\tests\TestCase;
use mmerlijn\laravelHelpers\tests\TestModel;

class PhoneCastTest extends TestCase
{

    use RefreshDatabase;


    public function test_phone_getter_and_setter()
    {
        $this->assertDatabaseCount('tests', 0);
        $model = TestModel::factory(['phone' => '06 123 123 12'])->create();
        $this->assertDatabaseHas('tests', ['phone' => '0612312312']);
        $this->assertEquals('06 1231 2312', $model->phone);

    }

    public function test_phone_null_setter_and_getter()
    {
        $model = TestModel::factory(['phone' => null])->create();
        $this->assertDatabaseHas('tests', ['id' => $model->id, 'phone' => ""]);
        $this->assertEquals('', $model->phone);
    }

    public function test_phone_with_country_code_stored_without()
    {
        $model = TestModel::factory(['phone' => "+31612345678"])->create();
        $this->assertDatabaseHas('tests', ['id' => $model->id, 'phone' => "0612345678"]);
        $this->assertEquals('06 1234 5678', $model->phone);

        $model = TestModel::factory(['phone' => "+31(0)612345678"])->create();
        $this->assertDatabaseHas('tests', ['id' => $model->id, 'phone' => "0612345678"]);
        $this->assertEquals('06 1234 5678', $model->phone);
    }

    public function test_phone_without_kental()
    {

        $model = TestModel::factory(['city' => 'Zaandam', 'phone' => "1234567"])->create();

        $this->assertDatabaseHas('tests', ['phone' => '0751234567']);
    }

    public function test_SMS_phone_valid()
    {

        $model = TestModel::factory(['phone' => "0612345678", 'city' => 'Zaandam'])->create();

        $this->assertDatabaseHas('tests', ['phone' => '0612345678']);
        $this->assertEquals('+31612345678', $model->phone->forSms());
        $this->assertEquals("+49612345678", $model->phone->forSms('de'));
    }

}