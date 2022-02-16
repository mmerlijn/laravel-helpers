<?php

namespace mmerlijn\laravelHelpers\tests\Unit;

use mmerlijn\laravelHelpers\Rules\Bsn;
use mmerlijn\laravelHelpers\tests\TestCase;

class BsnRuleTest extends TestCase
{
    public function test_bsn_pass()
    {
        $rule = new Bsn;
        $this->assertTrue($rule->passes('attribute', '123456782'));
        $this->assertTrue($rule->passes('attribute', ''));


    }

    public function test_bsn_fail()
    {
        $rule = new Bsn;
        $this->assertFalse($rule->passes('attribute', '123456789'));
        $this->assertFalse($rule->passes('attribute', 'abc'));
        $this->assertFalse($rule->passes('attribute', '000000000'));
    }

}