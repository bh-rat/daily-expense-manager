<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('quantity');    //quantity of the product purchased
            $table->decimal('amount');  //amount of the total bill
            $table->integer('pos_day_id');  //pos_day id for the day on which pos was made
            $table->integer('user_id'); //user who added it
            $table->integer('item_id'); //id of the item
            $table->decimal('rate');    //rate of the product
            $table->string('notes', 1000);  //extra notes for the
            $table->boolean('bill_available');  //is original bill available
            $table->integer('image_id');    //image of the bill
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
        Schema::dropIfExists('expenses');
    }
}
