<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productVariations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('productId');
            $table->integer('productImage');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->bigInteger('productPrice');
            $table->bigInteger('salePrice')->nullable();
            $table->string('productCoupenCode')->nullable();
            $table->bigInteger('discountAmount');
            $table->tinyInteger('onsale');
            $table->bigInteger('stockQuantity');
            $table->string('stockStatus');
            $table->bigInteger('totalSales');
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
        Schema::dropIfExists('productVariations');
    }
}
