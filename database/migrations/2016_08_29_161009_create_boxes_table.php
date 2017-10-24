<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		Schema::create('boxes', function (Blueprint $table) {
			
            $table->increments('id');
			$table->integer('order_id');
			$table->string('name');
			$table->string('image');
			$table->boolean('arrived')->default(false);
			$table->boolean('picked')->default(false);
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
        
		Schema::drop('boxes');
    }
}
