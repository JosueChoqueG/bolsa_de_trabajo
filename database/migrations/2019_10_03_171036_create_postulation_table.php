<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostulationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postulation', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('job_offer_id')->unsigned();
			$table->integer('candidate_id')->unsigned();
			$table->integer('curriculum_id')->unsigned();
			$table->enum('status', array('Enviado','Visto','Finalista'));
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
		Schema::drop('postulation');
	}

}
