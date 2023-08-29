<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeolocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geolocation', function(Blueprint $table)
		{
			$table->char('id', 6)->primary()->comment('Código de la ubicacion geografica');
			$table->char('department_code', 2)->comment('Código de ubigeo');
			$table->char('province_code', 2)->comment('Código de ubigeo');
			$table->char('district_code', 2)->comment('Código de ubigeo');
			$table->string('name', 100)->comment('Nombre de la ubicacion geografica');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('geolocation');
	}

}
