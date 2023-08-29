<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurriculumVitaeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curriculum_vitae', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('candidate_id');
			$table->string('path', 200);
			$table->string('name', 200);
			$table->boolean('status')->comment('0:inactivo, 1:activo');
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
		Schema::drop('curriculum_vitae');
	}

}
