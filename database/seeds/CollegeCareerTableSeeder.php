<?php

use Illuminate\Database\Seeder;

class CollegeCareerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('college_career')->truncate();
        
        DB::table('college_career')->insert(['id'=>'1','name' => 'Administración']);
        DB::table('college_career')->insert(['id'=>'2','name' => 'Ingeniería Agroindustrial']);
        DB::table('college_career')->insert(['id'=>'3','name' => 'Ingeniería de Minas']);
        DB::table('college_career')->insert(['id'=>'8','name' => 'Ingeniería Informática y Sistemas']);
        DB::table('college_career')->insert(['id'=>'9','name' => 'Medicina Veterinaria y Zootecnia']);
        DB::table('college_career')->insert(['id'=>'12','name' => 'Ingeniería Agroecológica y Desarrollo Rural']);
        DB::table('college_career')->insert(['id'=>'13','name' => 'Educación Inicial Intercultural Bilingüe Primera y Segunda Infancia']);
        DB::table('college_career')->insert(['id'=>'14','name' => 'Ciencia Política y Gobernabilidad']);
        DB::table('college_career')->insert(['id'=>'18','name' => 'Ingeniería Civil']);
    }
}
