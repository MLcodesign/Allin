<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('credit_deduct', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('order_id');
			$table->decimal('amount');
			$table->timestamp('created_at');
		 });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('credit_deduct');
    }
}
