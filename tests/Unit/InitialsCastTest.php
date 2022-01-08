<?php

namespace mmerlijn\laravelHelpers\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use mmerlijn\laravelHelpers\tests\TestModel;

class InitialsCastTest extends \mmerlijn\laravelHelpers\tests\TestCase
{
    use RefreshDatabase;

    public function test_setter_and_getter()
    {
        $model = TestModel::factory(['initials' => 'BAR'])->create();
        $this->assertEquals('B.A.R.', $model->initials);
        $model = TestModel::factory(['initials' => 'gh.'])->create();
        $this->assertEquals('G.H.', $model->initials);
        $this->assertDatabaseHas('tests', ['initials' => 'GH']);

        $model = TestModel::factory(['initials' => 'gh.+123'])->create();
        $this->assertEquals('G.H.', $model->initials);
    }
}