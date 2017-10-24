<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
			
            $table->increments('id');
            $table->integer('user_id');
			
			$table->integer('package_id');
			$table->integer('pricing_id');
			
			$table->integer('quantity');
			$table->integer('amt_service');
			
			
			$table->date('pickup_date');
			$table->string('pickup_time');
			$table->date('shipping_date');
			$table->string('shipping_time');
			$table->string('schedule_option');
			
			
			
			$table->string('shipping_fee');
			$table->string('monthly_cost');
			
			$table->string('address');
			$table->string('county');
			$table->string('district');
			$table->string('zipcode');
			$table->string('phone');
			
			$table->string('note');
			$table->integer('status')->default(0);
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
        Schema::drop('orders');
    }
}
