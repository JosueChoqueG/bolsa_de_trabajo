<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCandidateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidate', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('document', 11);
			$table->string('name', 50);
			$table->string('first_lastname', 50);
			$table->string('second_lastname', 50);
			$table->enum('gender', array('M','F'));
			$table->date('birthdate');
			$table->enum('civil_status', array('Soltero(a)','Casado(a)','Divorciado(a)','Viudo(a)','Conviviente'));
			$table->string('first_phone', 15)->nullable();
			$table->string('second_phone', 15)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('path_photo', 50)->nullable();
			$table->enum('disability', array('Ninguno','Para ver','Para oír','Para Hablar','Para usar extremidades','Otros'))->nullable()->default('Ninguno');
			$table->boolean('status');
			$table->string('password')->nullable();
			$table->date('activity_date')->nullable();
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
		Schema::drop('candidate');
	}

}
