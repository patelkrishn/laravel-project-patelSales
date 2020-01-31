<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId')->nullable();
            $table->integer('sellerId')->nullable();
            $table->string('name');
            $table->bigInteger('mobile');
            $table->string('street');
            $table->string('landmark');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('pincode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
