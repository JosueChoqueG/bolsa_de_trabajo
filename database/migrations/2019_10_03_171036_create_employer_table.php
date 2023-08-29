<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employer', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ruc', 11);
			$table->string('name', 100)->nullable();
			$table->string('tradename', 100)->nullable();
			$table->string('address', 300);
			$table->string('email', 50);
			$table->string('password')->nullable();
			$table->integer('sector_id')->unsigned();
			$table->text('description', 65535)->nullable();
			$table->string('web_page', 200)->nullable();
			$table->string('path_logo', 200)->nullable();
			$table->string('contact_name', 50);
			$table->string('contact_lastname', 50);
			$table->string('contact_role', 100);
			$table->string('contact_first_phone', 15);
			$table->string('contact_second_phone', 15)->nullable();
			$table->enum('status', array('En revisión','Inactivo','Activo'))->default('En revisión');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employer');
	}

}
