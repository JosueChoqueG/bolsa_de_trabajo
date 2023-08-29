<?php

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('area')->truncate();

        DB::table('area')->insert(['name' => 'Abastecimiento y Logística']);
        DB::table('area')->insert(['name' => 'Administración']);
        DB::table('area')->insert(['name' => 'Contabilidad y Finanzas']);
        DB::table('area')->insert(['name' => 'Aduana y Comercio Exterior']);
        DB::table('area')->insert(['name' => 'Atención al Cliente']);
        DB::table('area')->insert(['name' => 'Call Center y Telemarketing']);
        DB::table('area')->insert(['name' => 'Comercial']);
        DB::table('area')->insert(['name' => 'Ventas y Negocios']);
        DB::table('area')->insert(['name' => 'Comunicación']);
        DB::table('area')->insert(['name' => 'Relaciones Institucionales y Públicas']);
        DB::table('area')->insert(['name' => 'Diseño']);
        DB::table('area')->insert(['name' => 'Educación']);
        DB::table('area')->insert(['name' => 'Docencia e Investigación']);
        DB::table('area')->insert(['name' => 'Enfermería']);
        DB::table('area')->insert(['name' => 'Gastronomía y Turismo']);
        DB::table('area')->insert(['name' => 'Ingeniería Civil y Construcción']);
        DB::table('area')->insert(['name' => 'Legales']);
        DB::table('area')->insert(['name' => 'Marketing y Publicidad']);
        DB::table('area')->insert(['name' => 'Minería, Petróleo y Gas']);
        DB::table('area')->insert(['name' => 'Pasantía / Trainee']);
        DB::table('area')->insert(['name' => 'Producción y Manufactura']);
        DB::table('area')->insert(['name' => 'Salud']);
        DB::table('area')->insert(['name' => 'Medicina y Farmacia']);
        DB::table('area')->insert(['name' => 'Secretarias y Recepción']);
        DB::table('area')->insert(['name' => 'Seguros']);
        DB::table('area')->insert(['name' => 'Sociología / Trabajo Social']);
        DB::table('area')->insert(['name' => 'Sistemas y Telecomunicaciones']);
        DB::table('area')->insert(['name' => 'Tecnología']);
    }
}
