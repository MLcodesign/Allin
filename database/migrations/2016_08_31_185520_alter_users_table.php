<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
		{
			$table->string('county');
			$table->string('district');
			$table->string('zipcode');
			
			$table->decimal('total_credit');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
		{
			$table->dropColumn('county');
			$table->dropColumn('district');
			$table->dropColumn('zipcode');
			$table->dropColumn('total_credit');
		});
    }
}
