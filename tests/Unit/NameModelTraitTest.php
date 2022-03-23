<?php

namespace mmerlijn\laravelHelpers\tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use mmerlijn\laravelHelpers\tests\TestCase;
use mmerlijn\laravelHelpers\tests\TestModel;

class NameModelTraitTest extends TestCase
{

    use RefreshDatabase;


    public function test_name_storage()
    {
        $model = TestModel::factory()->create();
        $this->assertDatabaseHas('tests', ['own_lastname' => $model->own_lastname]);

        $model->refresh();
        $this->assertSame(null, $model->lastname);
        $this->assertDatabaseHas('tests', ['own_lastname' => $model->own_lastname, 'lastname' => null]);
        $this->assertSame('', $model->name->lastname);
        $this->assertSame($model->own_lastname, $model->name->own_lastname);
    }

    public function test_initials_storage()
    {
        TestModel::factory()->create();
        $p = TestModel::first();
        $p->name->initials = "M.M.";
        $p->save();
        $this->assertSame('M.M.', $p->name->getInitials());
        $this->assertSame('MM', $p->name->getInitialsForStorage());
        $this->assertDatabaseHas('tests', ['id' => 1, 'initials' => 'MM']);
    }

    public function test_name_formatter()
    {
        $p = TestModel::factory()->create();

        $p->name->setSex("F");
        $p->name->lastname = "de Velden";
        $p->name->prefix = "van de";
        $p->name->own_prefix = "";
        $p->name->own_lastname = "de Groot";


        $p->save();
        $p->refresh();
        $this->assertDatabaseHas('tests', ['lastname' => 'Velden', 'prefix' => 'van de', 'own_lastname' => "Groot", "own_prefix" => "de"]);
    }

}