<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pricings', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('gift_amount');
			$table->string('redeem_points');
			$table->string('get_points');
			$table->boolean('featured')->default(false);
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
        Schema::drop('pricings');
    }
}
