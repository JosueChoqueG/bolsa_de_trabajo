@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Mis ofertas laborales </li>
         
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-briefcase icons fa-lg"></i> Mis Ofertas laborales</h5>
            </div>
            <div class="card-body">
                <div class="row mt-2 ">
                    <div class="col-md-6">
                        <div class="pull-left">
                            <div class="">
                                @if (permission('internalJobOffers.create'))
                                <button class="btn btn-primary btn-sm  " id="btnViewRegister" ><span class="fa fa-plus"></span> Nuevo registro</button>
                                @endif
                                <a href="{{url('admin/internalJobOffers')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <form class="navbar-form " method="GET" action="{{ url('admin/internalJobOffers')}}" id="frmBuscar" >
                            <div class="input-group mb-3">
                                {{--  <div class="input-group-prepend">
                                    <select name="slc_search" id="slc_search" class="form-control form-control-sm" >
                                        <option value="ruc"{{ $slc_search =='ruc'?'selected':'' }}>Ruc</option>
                                        <option value="name" {{ $slc_search =='name'?'selected':'' }}>Nombre</option>
                                    </select>
                                </div>  --}}
                                <input type="search" class="form-control form-control-sm" placeholder="Ingrese titulo" name="title" value="{{ @$parameter }}" id="parameter">
                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                        
                </div><!--row-->
                <div class="table-responsive" id="content_table">
                    <table class="table  table-sm table-hover  table-bordered table-border" >
                            <thead style="cursor:pointer">
                                <tr>
                                    <th>Título</th>
                                    <th>Puestos</th>  
                                    <th>Vistas</th>          					          				
                                    <th>Periodo convocatoria</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="table_body" >
                                
                                @foreach($job_offers as $job_offer)
                                <tr id="{{ $job_offer->id }}">
                                    <td>{{$job_offer->title}} {{$job_offer->title_complement}}</td>
                                    <td>{{ $job_offer->vacancies }}</td>
                                    <td>{{ $job_offer->view_counter }}</td>
                                    <td>{{ date_format(date_create($job_offer->publication_date),"d/m/Y")}} - {{ date_format(date_create($job_offer->finish_date),"d/m/Y")}}</td>                                   
                                    <td> 
                                        @if ($job_offer->status == 3)
                                            <span class="badge badge-secondary">Cerrado</span>
                                        @elseif($job_offer->status == 2)
                                        <span class="badge badge-success">Publicado</span>
                                        @else  
                                        <span class="badge badge-warning">En revisión</span>  
                                        @endif
                                    </td>
                                    <td>	
                                        @if (permission('internalJobOffers.update'))
                                        <button type="button" class=" btn btn-xs btn-primary btn-square edit" ><i class='fa fa-edit'></i> Editar</button>
                                        @endif
                                        @if (permission('internalJobOffers.sendEmails'))
                                        <button type="button" class=" btn btn-xs btn-light btn-square send" ><i class='fa fa-envelope-o'></i> Enviar email  <span class="badge badge-primary">{{ $job_offer->emails_count }}</span> </button>
                                        @endif
                                        @if (permission('internalJobOffers.delete'))
                                        <button type="button" class=" btn btn-xs btn-danger btn-square delete" ><i class='fa fa-trash'></i> Eliminar</button>
                                        @endif
                                      
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div>
                        <div class="float-left">
                            Mostrando de {{ $job_offers->firstItem()}} al  {{ $job_offers->lastItem()}} de  {{ $job_offers->total()}} registros 
                        </div>
                        <div class="float-right">
                            {{$job_offers->appends(Request::only(['title']))->render()}}   
                        </div>
                        </div>
                </div>
            </div> 
		</div>
	</div>			
</div>
{{--  Formulario de registro avisos  --}}
<div class="row" id="content_register" style="display: none;">
    <div class="col-md-12 ">
       
        <div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-briefcase icons fa-lg"></i> Registro de avisos</h5>
            </div>
              <form id="frmRegister" method="post" action="">
                <div class="card-body" >
                   
                    <div class="row">
                       <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <div class="float-right">
                                    <button type="button" class="btn btn-default btn-sm btn-list"  > <i class="fa fa-reply"></i>   Volver</button> 
                            </div>
                        </div>
                    </div>
                  
                    <fieldset>
                        <legend>Datos de aviso :</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Puesto/Titulo de la oferta laboral*</label>
                                <input type="text" class="form-control" id="title" placeholder="Nombre del puesto o Título de la oferta laboral" name="title" value="" required>
                                <em id="title-error" class="error invalid-feedback messages"></em> 
                            </div>
                            <div class="form-group col-md-6">
                                <label>Complemento del titulo</label>
                                <input type="text" class="form-control" id="title_complement"  name="title_complement" value="">
                                <em id="title_complement-error" class="error invalid-feedback messages"></em> 
                            </div>
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label>Introdución*</label>
                                    <textarea type="text" class="form-control" rows="4" cols="5" id="introduction"  name="introduction" required placeholder="Ingrese una introducción"></textarea>
                                    <em id="introduction-error" class="error invalid-feedback messages"></em> 
                                </div>
                                <div class="form-group col-md-2 text-center" style="">
                                    <div class="card border-secondary mb-3" style="max-width: 10rem;">
                                        <div class="card-body" style="padding: 10px !important;">
                                            <p class="card-text">
                                                <small class="mr-2">¿Cómo llenar la introducción de mi oferta laboral?</small>
                                            </p>
                                            <i class="icon-question icons font-2xl d-block " id="i_open_modal_introduction" title="Haz Clic" style="cursor: pointer;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label>Descripción*</label>
                                <textarea type="text" class="form-control" id="description"  name="description" required>
                                    
                                </textarea>
                                <em id="description-error" class="error invalid-feedback messages"></em> 
                            </div>
                            <div class="form-group col-md-2 text-center" style=" margin-top: 9%;">
                                
                                <div class="card border-secondary mb-3" style="max-width: 10rem;">
                                    <div class="card-body" style="padding: 10px !important;">
                                        <p class="card-text">
                                            <small class="mr-2">¿Cómo llenar la descripción de mi oferta laboral?</small> 
                                        </p>
                                        <i class="icon-question icons font-2xl d-block mt-4" id="i_open_modal" title="Click para ver ejemplo" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoría de la oferta*</label>
                                    <select type="text" class="form-control" id="category"  name="category" required>
                                        <option value="">--Seleccione--</option>
                                        <option value="Empleo">Empleo</option>
                                        <option value="Prácticas" >Prácticas</option>
                                        <option value="Becas/Pasantías">Becas/Pasantías</option>
                                    </select>
                                    <em id="category-error" class="error invalid-feedback messages"></em> 

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Area*</label>
                                    <select class="form-control" id="area_id" name="area_id" required>
                                        <option value="">--Seleccione--</option>
                                        @foreach ($areas as $area)
                                            <option value="{{old('area_id',$area->id)}}"  >{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="area_id-error" class="error invalid-feedback messages"></em> 
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Carreras a las que debe pertenecer el postulate*</label>
                                    @foreach ($colleges as $college)
                                    
                                    <div class="form-check" >
                                        <input class="form-check-input" type="checkbox" value="{{ $college->id }}" class="college_id" id="college_{{$college->id}}" name="college_id[]">
                                        <label for="college_{{$college->id}}" class="form-check-label">
                                                {{$college->name}}
                                        </label>
                                        
                                    </div>
                                    
                                    @endforeach
                                    <em id="college_id-error" style="color: tomato;"></em>
                                    
                            </div>
                            <div class="form-group col-md-3 text-center">
                                <label >Logo*</label><br>
                                <img src="{{asset('/img/employer/logo/default.JPG')}}"  class="img-responsive img-thumbnail" width="150" id="foto"><br>
                                <a class="btn btn-square btn-warning mt-2" type="button" id="a_path_logo">
                                    <i class="fa fa-plus"></i>&nbsp;Seleccionar logo
                                </a><br>
                                <input type="text"  class="mt-2" value="" name="path_logo" id="path_logo" readonly>
                                <em id="path_logo_id-error" class="error invalid-feedback messages"></em> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Pais*</label>
                                    <select class="form-control" id="countrie_id" name="countrie_id">
                                        @foreach ($countries as $countrie)
                                            <option value="{{  $countrie->id}}"  {{(@$countrie->id == '173')?'selected':''}}>{{$countrie->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="countrie_id-error" class="error invalid-feedback messages"></em> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Departamento</label>
                                    <select class="form-control" id="department_code"  name="department_code">
                                        <option value=""></option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id}}">{{ $department->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="departament_code-error" class="error invalid-feedback messages"></em> 
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Provincia</label>
                                <select class="form-control" id="province_code" name="province_code">

                                </select>
                                <em id="province_code-error" class="error invalid-feedback messages"></em> 
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Distrito*</label>
                                <select class="form-control" id="district_code" name="district_code">
                                </select>
                                <em id="district_code-error" class="error invalid-feedback messages"></em>                                     
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Jornada laboral*</label>
                                <select  class="form-control" id="workday"  name="workday" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="Tiempo completo" {{(@$job_offer->workday== 'Tiempo completo')?'selected':''}}>Tiempo completo</option>
                                    <option value="Medio tiempo" {{(@$job_offer->workday== 'Medio tiempo')?'selected':''}}>Medio tiempo</option>
                                    <option value="Por horas" {{(@$job_offer->workday== 'Por horas')?'selected':''}}>Por horas</option>
                                </select>
                                <em id="workday-error" class="error invalid-feedback messages"></em> 

                            </div>
                            <div class="form-group col-md-3">
                                <label>Salario*</label>
                                <select  class="form-control form-control-sm" id="type_salary"  name="type_salary" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="A tratar">A tratar</option>
                                    <option value="Fijo" >Fijo</option>
                                    <option value="Rango" >Rango</option>
                                </select>
                                <em id="type_salary-error" class="error invalid-feedback messages"></em> 
                                <div class="col-md-12 mt-2">
                                    <div class="row">
                                        <div class="form-group col-md-6" id="div_salary_min" style="display:none;">
                                            <label>Monto Mín.*</label>
                                            <input type="number" class="form-control " id="salary_min"  name="salary_min"  value="{{old('salary_min',@$job_offer->salary)}}">
                                            <em id="salary_min-error" class="error invalid-feedback messages"></em> 
                                        </div>
                                        <div class="form-group col-md-6" id="div_salary_max" style="display:none;">
                                            <label>Monto Máx.*</label>
                                            <input type="number" class="form-control " id="salary_max"  name="salary_max" value="{{old('salary_max',@$job_offer->salary)}}">
                                            <em id="salary_max-error" class="error invalid-feedback messages"></em> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Vacantes*</label>
                                <input type="number" class="form-control form-control-sm" id="vacancies" placeholder="Nro Vacantes" name="vacancies" value="" required>
                                <em id="vacancies-error" class="error invalid-feedback messages"></em> 
                            </div>
                            <div class="form-group col-md-3">
                                <label>Vigencia del empleo*</label>
                                <input type="text" class="form-control" id="validity_time" placeholder="Ejem: 3 Meses " name="validity_time" >
                                <em id="validity_time-error" class="error invalid-feedback messages"></em> 
                                {{-- <select  class="form-control" id="type_validity"  name="type_validity" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="Por definir" >Por definir</option>
                                    <option value="Definido">Definido</option>
                                    <option value="Indefinido" >Indefinido</option>
                                </select>
                                <em id="type_validity-error" class="error invalid-feedback messages"></em>  --}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Fecha de publicación*</label>
                                <input type="date" class="form-control form-control-sm" id="publication_date"  name="publication_date"  required>
                                <em id="publication_date-error" class="error invalid-feedback messages"></em> 
                                <small id="mensaje_publication_date" style="color:#20c997;">¡Esta fecha se almacenará sólo si el estado de esta publicación es publicado!</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Estado*</label>
                                <select  class="form-control form-control-sm" id="status"  name="status" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="1" >En revisión</option>
                                    <option value="2">Publicado</option>
                                    <option value="3" >Cerrado</option>
                                </select>
                                <em id="status-error" class="error invalid-feedback messages"></em> 
                            </div>
                            <div class="form-group col-md-3">
                                <label>Fecha de cierre*</label>
                                <input type="hidden" name="today" value="{{old('salary',@$today)}}">
                                <input type="date" class="form-control form-control-sm" id="finish_date"  name="finish_date" value="" required>
                                <em id="finish_date-error" class="error invalid-feedback messages"></em> 
                            </div>
                            
                        </div>  
                    </fieldset>    
                       
                </div>
                <div class="card-footer"> 
                    <button type="button" class="btn btn-default btn-sm btn-list">Cancelar</button> 
                    <button type="submit" class="btn btn-primary btn-sm btnSave" id="btnSave"> <i class=""></i> Guardar</button>  
                </div> 
            </form>
        </div>
    </div>			
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_example_introduction">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Como llenar la introdución de mi oferta laboral?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Ejemplo1:</strong> ¡¡ÚNETE A NUESTRA FAMILIA DYNAMICALL!!!
                Nos encontramos en búsqueda de TELEOPERADORES turno (MAÑANA) en FULL TIME para el área de Atención al cliente Postpago Movil</p>
                <p><strong>Ejemplo2:</strong> importante empresa transnacional de Call Center con 20 años en el rubro de Telecomunicaciones, que cuenta con operaciones en Latinoamérica brindando servicio a reconocida compañía de telefonía móvil en el país, se encuentra en búsqueda de nuevos talentos para laborar como Teleoperadores de Atención al Cliente para nuestra Sede de LINCE</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_path_logo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">RECURSOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <a  href="#" id="a_add">Añadir Recurso</a> --}}
                <div class="row mt-2 ">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Imagenes</a>
                        </li>
                        {{--  <li class="nav-item">
                            <a class="nav-link" id="pdf-tab" data-toggle="tab" href="#pdf" role="tab" aria-controls="pdf" aria-selected="false">PDF</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false">Doc</a>
                        </li>  --}}
                    </ul>
                    <div class="tab-content" id="myTabContent" style="border-bottom: none;">
                        <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="image-tab">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <form class="navbar-form " method="GET" id="frmBuscarImage">
                                            @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <select name="slc_search" id="slc_search" class="form-control form-control-sm">
                                                    <option value="name">Nombre del archivo</option>
                                                    <option value="created_at">Fecha de creación</option>
                                                </select>
                                                <input type="hidden" name="type" value="image">
                                            </div>
                                            <input type="search" class="form-control form-control-sm" placeholder="" name="parameter" value="{{old('parameter',@$parameter)}}" id="parameter">
                                            <div class="input-group-append" id="button-addon4">
                                                <button class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                            </div>
                                        </div>
                                    </form>
                                </li>
                                <li class="list-group-item resource" id="li_image" style="border-bottom: none;">
                                </li>
                            </ul>
                            <p style="visibility: hidden;height: 0px;margin-bottom: 0px;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi tempore sapiente quo architecto ex consequatur magnam, fugit quos facere. Corporis placeat dolores, nam assumenda atque voluptas eaque debitis sed cumque.</p>

                        </div>
                        <div class="tab-pane fade" id="pdf" role="tabpanel" aria-labelledby="pdf-tab"> 
                            <ul class="list-group list-group-flush"> 
                                <li class="list-group-item">                          
                                    <form class="navbar-form " method="GET" id="frmBuscarPdf">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <select name="slc_search" id="slc_search" class="form-control form-control-sm">
                                                    <option value="name">Nombre del archivo</option>
                                                    <option value="created_at">Fecha de creación</option>
                                                </select>
                                                <input type="hidden" name="type" value="pdf">
                                            </div>
                                            <input type="search" class="form-control form-control-sm" placeholder="" name="parameter" value="{{old('parameter',@$parameter)}}" id="parameter">
                                            <div class="input-group-append" id="button-addon4">
                                                <button class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                            </div>
                                        </div>
                                    </form>
                                </li> 
                                <li class="list-group-item resource" id="li_pdf" style="border-bottom: none;">  

                                </li>
                                <p style="visibility: hidden;height: 0px;margin-bottom: 0px;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi tempore sapiente quo architecto ex consequatur magnam, fugit quos facere. Corporis placeat dolores, nam assumenda atque voluptas eaque debitis sed cumque.</p>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <form class="navbar-form " method="GET" id="frmBuscarDoc">
                                            @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <select name="slc_search" id="slc_search" class="form-control form-control-sm">
                                                    <option value="name">Nombre del archivo</option>
                                                    <option value="created_at">Fecha de creación</option>
                                                </select>
                                                <input type="hidden" name="type" value="doc">
                                            </div>
                                            <input type="search" class="form-control form-control-sm" placeholder="" name="parameter" value="{{old('parameter',@$parameter)}}" id="parameter">
                                            <div class="input-group-append" id="button-addon4">
                                                <button class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                            </div>
                                        </div>
                                    </form>
                                </li>
                                <li class="list-group-item resource" id='li_doc' style="border-bottom: none;">
                                    
                                </li>
                                <p style="visibility: hidden;height: 0px;margin-bottom: 0px;;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi tempore sapiente quo architecto ex consequatur magnam, fugit quos facere. Corporis placeat dolores, nam assumenda atque voluptas eaque debitis sed cumque.</p>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <label for="" class=" col-form-label">Nombre del archivo</label>
                    <input type="text" class="form-control" id="name_modal" placeholder="nombre del archivo" disabled style="width: 50%;">
                    <input type="hidden" id="id_modal" class="">
                <div class="">
                    <button class="btn btn-square btn-block btn-info btn-sm" type="button" id="btn_usar">Elegir</button>
                </div>
                <div>
                    <button class="btn btn-square btn-block btn-dark btn-sm" type="button" id="btn_cancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.employer_job_offer.modal_example_job_offer')

@include('admin.internal_job_offer.modal_send_email')
@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{asset('assets_admin/develop_js/internal_job_offer/index_jscript.js?v1.5')}}"></script>
<script src="{{asset('assets_admin/develop_js/internal_job_offer/index_jquery.js?v1.5')}}"></script>
<script>
        function pulsar(e) 
        { 
            tecla = (document.all) ? e.keyCode :e.which; 
            
            return (tecla!=13); 
        }
</script>
@parent
@endsection 