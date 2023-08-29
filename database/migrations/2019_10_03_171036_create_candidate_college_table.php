<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCandidateCollegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidate_college', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 10);
			$table->char('admission_date', 6);
			$table->char('egress_date', 6);
			$table->integer('candidate_id')->unsigned();
			$table->integer('college_id')->unsigned();
			$table->enum('academic_situation', array('Estudiante','Egresado','Graduado'))->nullable();
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
		Schema::drop('candidate_college');
	}

}
