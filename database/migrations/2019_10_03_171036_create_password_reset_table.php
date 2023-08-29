<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('password_reset', function(Blueprint $table)
		{
			$table->string('email', 128)->index('password_resets_email_index');
			$table->enum('user_type', array('Empleador','Candidato','Usuario'));
			$table->string('token');
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('password_reset');
	}

}
