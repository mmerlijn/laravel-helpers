<?php

namespace mmerlijn\laravelHelpers\tests\Unit;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use mmerlijn\laravelHelpers\Casts\Phone;
use mmerlijn\laravelHelpers\Exceptions\SMSPhoneException;
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

    public function test_phone_without_kental()
    {
        $model = TestModel::factory(['phone' => "1234567", 'city' => 'Zaandam'])->create();
        $this->assertDatabaseHas('tests', ['phone' => '0751234567']);
    }

    public function test_SMS_phone_valid()
    {
        $model = TestModel::factory(['phone' => "0612345678", 'city' => 'Zaandam'])->create();
        $this->assertDatabaseHas('tests', ['phone' => '0612345678']);
        $this->assertEquals('+31612345678', $model->phone->smsPhone());
        $this->assertEquals("+49612345678", $model->phone->smsPhone('de'));
    }

    public function test_SMS_phone_exception()
    {
        $model = TestModel::factory(['phone' => "0202345678"])->create();
        $this->expectExceptionObject(new SMSPhoneException);
        $model->phone->smsPhone();
    }

    public function test_SMS_invalid_country_code()
    {
        $model = TestModel::factory(['phone' => "0602345678"])->create();
        $this->expectExceptionObject(new SMSPhoneException('Not a valid country code: gr'));
        $model->phone->smsPhone("gr");
    }
}