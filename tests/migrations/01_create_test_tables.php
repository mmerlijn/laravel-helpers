<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
//Class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //fast search table
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 20)->nullable();
            $table->string('city', 40)->nullable();
            $table->string('initials', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tests');
        Schema::enableForeignKeyConstraints();
    }
};