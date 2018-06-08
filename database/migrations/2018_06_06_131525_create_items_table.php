<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 400);    //name of the product
            $table->string('brand_name', 400);    //name of the product
            $table->integer('vendor_id');   //vendor id of the product
            $table->decimal('price')->nullable();    // price of the product
            $table->decimal('quantity')->nullable();    //quantity in which the product is sold
            $table->string('unit');    //quantity in which the product is sold
            $table->boolean('is_active');    //if the item is active
            $table->string('type')->nullable();    //type of the item
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
        Schema::dropIfExists('items');
    }
}
