<?php

namespace mmerlijn\laravelHelpers\Tests\Unit;

use mmerlijn\laravelHelpers\Rules\Requestnr;

class RequestnrRuleTest extends \mmerlijn\laravelHelpers\tests\TestCase
{
    public function test_requestnr_pass()
    {
        $rule = new Requestnr;
        $this->assertTrue($rule->passes('attribute', 'ZD12345678'));
        $this->assertTrue($rule->passes('attribute', 'PG123456789'));
        $this->assertTrue($rule->passes('attribute', 'CW12345678'));


    }

    public function test_requestnr_fail()
    {
        $rule = new Requestnr;
        $this->assertFalse($rule->passes('attribute', '123456789'));
        $this->assertFalse($rule->passes('attribute', 'ZD'));
        $this->assertFalse($rule->passes('attribute', 'ZD1234567'));
        $this->assertFalse($rule->passes('attribute', 'ZD1234567890'));
        $this->assertFalse($rule->passes('attribute', 'PG1234567'));
        $this->assertFalse($rule->passes('attribute', 'AG12345678'));
        $this->assertFalse($rule->passes('attribute', 'PG1234567890'));
    }

}