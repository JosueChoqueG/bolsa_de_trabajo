<?php

use Illuminate\Database\Seeder;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=====================================//
        //¨*********RUTAS ADMIN***************//
        //=====================================//
        // ****** rutas role **** 
        DB::table('route')->truncate();

        DB::table('route')->insert([
            'name'=>'Listar roles',
            'value'=>'roles.index',
            'description'=>'Listar roles',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear roles',
            'value'=>'roles.create',
            'description'=>'Crear roles',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Editar roles',
            'value'=>'roles.update',
            'description'=>'Editar roles',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar roles',
            'value'=>'roles.delete',
            'description'=>'Eliminar roles',
            'level' => '0'
        ]);
         // ****** rutas users **** 
         DB::table('route')->insert([
            'name'=>'Listar usuarios',
            'value'=>'users.index',
            'description'=>'Listar usuarios',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear usuarios',
            'value'=>'users.create',
            'description'=>'Crear usuarios',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Editar usuarios',
            'value'=>'users.update',
            'description'=>'Editar usuarios',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar usuarios',
            'value'=>'users.delete',
            'description'=>'Eliminar usuarios',
            'level' => '0'
        ]);
        // ****** rutas employers **** 
        DB::table('route')->insert([
            'name'=>'Listar empleadores',
            'value'=>'employers.index',
            'description'=>'Listar empleadores',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear empleadores',
            'value'=>'employers.create',
            'description'=>'Crear empleadores',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Editar empleadores',
            'value'=>'employers.update',
            'description'=>'Editar empleadores',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar empleadores',
            'value'=>'employers.delete',
            'description'=>'Eliminar empleadores',
            'level' => '0'
        ]);
         // ****** rutas candidates **** 
         DB::table('route')->insert([
            'name'=>'Listar estudiantes',
            'value'=>'candidates.index',
            'description'=>'Listar estudiantes',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear estudiantes',
            'value'=>'candidates.create',
            'description'=>'Crear estudiantes',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Editar estudiantes',
            'value'=>'candidates.update',
            'description'=>'Editar estudiantes',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar estudiantes',
            'value'=>'candidates.delete',
            'description'=>'Eliminar estudiantes',
            'level' => '0'
        ]);

         // ****** internalJobOffers **** 
         DB::table('route')->insert([
            'name'=>'Listar ofertas laborales internas',
            'value'=>'internalJobOffers.index',
            'description'=>'',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear ofertas laborales internas',
            'value'=>'internalJobOffers.create',
            'description'=>'',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Editar ofertas laborales internas',
            'value'=>'internalJobOffers.update',
            'description'=>'',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar ofertas laborales internas',
            'value'=>'internalJobOffers.delete',
            'description'=>'',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Enviar correos masivos',
            'value'=>'internalJobOffers.sendEmails',
            'description'=>'',
            'level' => '0'
        ]);

        // ****** externalJobOffers **** 
        DB::table('route')->insert([
            'name'=>'Listar ofertas de empleadores',
            'value'=>'employerJobOffers.index',
            'description'=>'',
            'level' => '1'
        ]);
        // DB::table('route')->insert([
        //     'name'=>'Crear ofertas de empleadores',
        //     'value'=>'employerJobOffers.create',
        //     'description'=>'',
        //     'level' => '0'
        // ]);
        DB::table('route')->insert([
            'name'=>'Editar ofertas de empleadores',
            'value'=>'employerJobOffers.update',
            'description'=>'',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar ofertas de empleadores',
            'value'=>'employerJobOffers.delete',
            'description'=>'',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Enviar correos masivos',
            'value'=>'employerJobOffers.sendEmails',
            'description'=>'',
            'level' => '0'
        ]);
         // ****** recursos **** 
         DB::table('route')->insert([
            'name'=>'Listar recursos',
            'value'=>'resources.index',
            'description'=>'Listar recursos',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear recursos',
            'value'=>'resources.create',
            'description'=>'Crear recursos',
            'level' => '0'
        ]);
        // DB::table('route')->insert([
        //     'name'=>'Editar recursos',
        //     'value'=>'resources.update',
        //     'description'=>'Editar recursos',
        //     'level' => '0'
        // ]);
        DB::table('route')->insert([
            'name'=>'Eliminar recursos',
            'value'=>'resources.delete',
            'description'=>'Eliminar recursos',
            'level' => '0'
        ]);

        // ****** publicaciones **** 
        DB::table('route')->insert([
            'name'=>'Listar publicaciones',
            'value'=>'publications.index',
            'description'=>'Listar publicaciones',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Crear publicaciones',
            'value'=>'publications.create',
            'description'=>'Crear publicaciones',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Editar publicaciones',
            'value'=>'publications.update',
            'description'=>'Editar publicaciones',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Eliminar publicaciones',
            'value'=>'publications.delete',
            'description'=>'Eliminar publicaciones',
            'level' => '0'
        ]);   
        DB::table('route')->insert([
            'name'=>'Galeria de publicaciones',
            'value'=>'publications.images',
            'description'=>'galería de publicaciones',
            'level' => '0'
        ]); 
        // ****** reportes****
        DB::table('route')->insert([
            'name'=>'Reportes',
            'value'=>'reports',
            'description'=>'Reporte',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Reporte estudiantes',
            'value'=>'report.candidates',
            'description'=>'Reporte de Estudiantes y egresados',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Descarga de Excel',
            'value'=>'report.candidatesExcelDownload',
            'description'=>'Descarga de excel',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Descarga de PDF',
            'value'=>'report.candidatesPdfDownload',
            'description'=>'Descarga de PDF',
            'level' => '0'
        ]);   

        DB::table('route')->insert([
            'name'=>'Reporte empleadores',
            'value'=>'report.employers',
            'description'=>'Reporte empleadores',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Descarga de Excel',
            'value'=>'report.employersExcelDownload',
            'description'=>'Descarga de excel',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Descarga de PDF',
            'value'=>'report.employersPdfDownload',
            'description'=>'Descarga de PDF',
            'level' => '0'
        ]); 

        DB::table('route')->insert([
            'name'=>'Reporte ofertas laborales',
            'value'=>'report.jobOffers',
            'description'=>'Reporte ofertas laborales',
            'level' => '1'
        ]);
        DB::table('route')->insert([
            'name'=>'Descarga de Excel',
            'value'=>'report.jobOffersExcelDownload',
            'description'=>'Descarga de excel',
            'level' => '0'
        ]);
        DB::table('route')->insert([
            'name'=>'Descarga de PDF',
            'value'=>'report.jobOffersPdfDownload',
            'description'=>'Descarga de PDF',
            'level' => '0'
        ]); 
    }
}
