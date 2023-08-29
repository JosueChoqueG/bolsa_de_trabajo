<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobOfferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_offer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array('interna','externa'));
			$table->enum('category', array('Practicas','Empleo'));
			$table->string('title', 100);
			$table->string('title_complement', 100)->nullable();
			$table->string('introduction', 500);
			$table->text('description', 65535);
			$table->string('slug', 128)->nullable()->unique('slug');
			$table->integer('countrie_id')->unsigned();
			$table->char('geolocation_id', 6)->nullable();
			$table->enum('workday', array('Medio tiempo','Tiempo completo','Por horas'))->comment('jornada laboral');
			$table->integer('area_id')->unsigned();
			$table->enum('type_salary', array('A tratar','Fijo'));
			$table->enum('type_validity', array('Por definir','Definido','Indefinido'));
			$table->string('validity_time', 5)->nullable();
			$table->text('academic_level', 65535)->nullable();
			$table->integer('vacancies')->comment('nro de vacantes');
			$table->date('publication_date')->nullable()->comment('fecha de publicacion');
			$table->date('finish_date')->comment('fecha limite');
			$table->float('salary', 10, 0)->nullable()->comment('salario ofrecido');
			$table->integer('employer_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('status')->comment('1:en revision,2:publicado,3cerrado');
			$table->string('path_logo', 200)->nullable();
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
		Schema::drop('job_offer');
	}

}
