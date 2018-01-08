<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferaldata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('referal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('referral_id');
            $table->decimal('referral_amount');
            $table->decimal('bouns_ammount');
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
        //
    }
}
