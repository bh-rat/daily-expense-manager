    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_days', function (Blueprint $table) {
            $table->increments('id');
            $table->date('pos_date');   //date of the pos
            $table->boolean('opening_balance_match');   //date of the pos
            $table->string('opening_notes', 1000)->nullable();  //Notes for the day while opening
            $table->string('closing_notes', 1000)->nullable();  //Notes for the day while closing
            $table->integer('opening_cash_in_drawer')->nullable(); //cash in drawer in the start of the day
            $table->integer('expense')->nullable(); //total expense in a day
            $table->integer('closing_cash_in_dawer')->nullable(); //cash in drawer in the end of the day
            $table->integer('opened_by_user_id')->nullable(); //cash in drawer in the end of the day
            $table->integer('closed_by_user_id')->nullable(); //cash in drawer in the end of the day
            $table->integer('difference')->nullable(); //difference between the expected and actual cash.
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
        Schema::dropIfExists('pos_days');
    }
}
