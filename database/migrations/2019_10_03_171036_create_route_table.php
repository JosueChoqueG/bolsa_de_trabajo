<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('route', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 30);
			$table->string('value', 100);
			$table->string('description', 100)->nullable();
			$table->boolean('level')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('route');
	}

}
