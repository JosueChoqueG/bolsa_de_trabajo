@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Estudiantes</li>
         
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Estudiantes/Egresados</h5>
            </div>
            <div class="card-body">
                <div class="row mt-2 ">
                    <div class="col-md-6">
                        <div class="pull-left">
                            <div class="">
                                @if (permission('candidates.create'))
                                <button class="btn btn-primary btn-sm  " id="btnViewRegister" ><span class="fa fa-plus"></span> Nuevo registro</button>
                                @endif
                                <a href="{{url('admin/candidates')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <form class="navbar-form " method="GET" action="{{ url('admin/candidates')}}" id="frmBuscar" >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select name="slc_search" id="slc_search" class="form-control form-control-sm" >
                                        <option value="document"{{ $slc_search =='document'?'selected':'' }}>DNI/CE</option>
                                        <option value="name" {{ $slc_search =='name'?'selected':'' }}>Nombre</option>
                                        <option value="lastname" {{ $slc_search =='lastname'?'selected':'' }}>Apellidos</option>
                                    </select>
                                </div>
                                <input type="search" class="form-control form-control-sm" placeholder="" name="{{ $slc_search != null ?$slc_search :'document' }}" value="{{ @$parameter }}" id="parameter">
                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                        
                </div><!--row-->
                <div class="table-responsive" id="content_table">
                    <table class="table  table-sm table-hover  table-bordered table-border" >
                            <thead >
                                <tr>
                                    <th>DNI</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>          					          				
                                    <th>Sexo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="list_candidates" >
                                
                                @foreach($candidates as $candidate)
                                <tr id="{{ $candidate->id }}">
                                    <td>{{$candidate->document}}</td>
                                    <td>{{$candidate->name}}</td>
                                    <td>{{$candidate->first_lastname}} {{$candidate->second_lastname}}</td>
                                    <td>{{$candidate->gender}}</td>
                                    <td> 
                                        @if ($candidate->status == 0)
                                            <span class="badge badge-secondary">Inactivo</span>
                                        @else
                                        <span class="badge badge-success">Activo</span>
                                        @endif
                                    </td>
                                    <td>	
                                        @if (permission('candidates.update'))
                                        <button  type="button" class=" btn btn-xs btn-secondary btn-square edit" ><i class='fa fa-edit'></i> Editar</button>
                                        @endif
                                        @if (permission('candidates.delete'))
                                        <button type="button" class=" btn btn-xs btn-danger btn-square delete" ><i class='fa fa-trash'></i> Eliminar</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div>
                        <div class="float-left">
                            Mostrando de {{ $candidates->firstItem()}} al  {{ $candidates->lastItem()}} de  {{ $candidates->total()}} registros 
                        </div>
                        <div class="float-right">
                            {{$candidates->appends(Request::only(['name','lastname','document']))->render()}}   
                        </div>
                        </div>
                </div>
            </div> 
		</div>
	</div>			
</div>
{{--  Formulario de registro empleadores  --}}
<div class="row" id="content_register" style="display: none;">
    <div class="col-md-12 ">
       
        <div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Registro estudiantes/egresados</h5>
            </div>
              
                <div class="card-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <div class="float-right">
                                    <button type="button" class="btn btn-default btn-sm btn-list"  > <i class="fa fa-reply"></i>   Volver</button> 
                            </div>
                        </div>
                    </div>
                    <form role="form"  method="POST" action=""  id="frmRegister"> 
                    <fieldset>
                        <legend>Datos personales:</legend>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="field-2" class="">DNI</label> 
                                                <input type="text" class="form-control " id="document" onkeypress="return pulsar(event)" name="document" placeholder=" Ingrese nro DNI ">
                                                <em id="document-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="field-1" class="">Nombre</label> 
                                            <input type="text" class="form-control " onkeypress="return pulsar(event)" id="name"  name="name" placeholder="Ingrese nombre" >
                                            <em id="name-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="field-1" class="">Apellido paterno</label> 
                                            <input type="text" class="form-control " id="first_lastname" onkeypress="return pulsar(event)"  name="first_lastname" placeholder="Ingrese apellido paterno" >
                                            <em id="first_lastname-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div> 
                                    <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="field-1" class="">Apellido materno</label> 
                                            <input type="text" class="form-control " id="second_lastname" onkeypress="return pulsar(event)"  name="second_lastname" placeholder="Ingrese apellido materno" >
                                            <em id="second_lastname-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="field-1" class="">Sexo</label> 
                                            <select name="gender" id="gender" class="form-control form-control-sm">
                                                <option value="">Seleccione</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                            <em id="gender-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="field-1" class="">Fecha de nacimiento</label> 
                                            <input type="date" class="form-control " id="birthdate" onkeypress="return pulsar(event)"  name="birthdate" placeholder="Ingrese fecha de nacimiento" >
                                            <em id="birthdate-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="field-1" class="">Estado civil</label> 
                                            <select name="civil_status" id="civil_status" class="form-control form-control-sm">
                                                <option value="">Seleccione</option>
                                                <option value="Soltero(a)">Soltero(a)</option>
                                                <option value="Conviviente">Conviviente</option>
                                                <option value="Casado(a)">Casado(a)</option>
                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                <option value="Viudo(a)">Viudo(a)</option>
                                            </select>
                                            <em id="civil_status-error" class="error invalid-feedback"></em>  
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <img src="{{asset('/img/candidate/photo/default.JPG')}}"  class="img-responsive img-thumbnail" width="150" id="foto"><br>
                                <label for="field-1" class="">Fotografía</label> 
                                <input type="file" id="photo"  data-buttonname="btn-white" class="form-control input-sm" name="photo">
                                <em id="photo-error" class="error invalid-feedback"></em>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Limitacíon Física</label> 
                                    <select name="disability" id="disability" class="form-control form-control-sm">
                                        <option value="">Seleccione</option>
                                        <option value="Ninguno">Ninguno</option>
                                        <option value="Para ver">Para ver</option>
                                        <option value="Para oír">Para oír</option>
                                        <option value="Para hablar">Para hablar</option>
                                        <option value="Para usar extremidades">Para usar extremidades</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                    <em id="disability-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                        </div> 
                        
                    </fieldset>
                    <fieldset>
                        <legend>Datos de contacto:</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Correo electrónico</label> 
                                    <input type="text" class="form-control " id="email" onkeypress="return pulsar(event)"  name="email" placeholder="Ingrese email" >
                                    <em id="email-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="">Nro telef 1.</label> 
                                        <input type="text" class="form-control " id="first_phone" onkeypress="return pulsar(event)" name="first_phone" placeholder="Ingrese nro de teléfono">
                                        <em id="first_phone-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Nro telef 2. <small>(opcional)</small></label> 
                                    <input type="text" class="form-control " onkeypress="return pulsar(event)" id="second_phone"  name="second_phone" placeholder="Ingrese nro de teléfono " >
                                    <em id="second_phone-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            
                        </div>
                        
                    </fieldset>
                    <fieldset>
                        <legend>Datos de acceso:</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Estado</label> 
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>
                                    <em id="status-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            {{--  <div class="col-md-6">
                                <button  type="button" class="btn btn-outline-warning mt-4 ">Resetear Contraseña</button>
                            </div>  --}}
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Datos académicos:</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="float-right">
                                                    <button type="button" class="btn btn-primary btn-sm mb-2" id="addCollege"> <i class="fa fa-plus"></i> Agregar Escuela</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr id="">
                                                <th>Escuela</th>
                                                <th>Código</th>
                                                {{--  <th>Situacion académica</th>  --}}
                                                {{-- <th>Semestre de ingreso</th>
                                                <th>Semestre de egreso</th> --}}
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_college">

                                        </tbody>
                                        <tfoot id="footer_template" hidden>
                                            <tr>
                                                <td>
                                                    <select name="" class="form-control form-control-sm item_carrera_id" >
                                                        <option value="" >Seleccione</option >
                                                        @foreach ($colleges as $college)
                                                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text"class="form-control item_codigo"  placeholder="Ejm: 101006" >
                                                </td>
                                                {{--  <td>
                                                    <select name="item_situacion[]" class="form-control item_situacion" required>
                                                        <option value="" >Seleccione</option >
                                                        <option value="Estudiante">Estudiante</option> 
                                                        <option value="Egresado"> Egresado</option> 
                                                        <option value="Graduado">Graduado</option>    
                                                    </select>
                                                </td>  --}}
                                                {{-- <td>
                                                    <input type="text"  class="form-control item_ingreso" placeholder="Ejm: 2010-1" >
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item_egreso"  placeholder="Ejm: 2016-1">
                                                </td> --}}
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-xs delete"> <i class="fa fa-trash"></i> Eliminar</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="alert alert-danger alert-dismissible" id="alert_college" style="display: none;"  role="alert">
                                        <p id="msg_college"></p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>    
                </div>
                <div class="card-footer"> 
                    <button type="button" class="btn btn-default btn-sm btn-list"  >Cancelar</button> 
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSave"> <i class=""></i> Guardar</button>  
                </div> 
            
        </div>
        </form>
    </div>	
    	
</div>


@endsection

@section('scripts')
<script src="{{asset('assets_admin/develop_js/candidate/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/candidate/index_jquery.js')}}"></script>
<script>
        function pulsar(e) 
        { 
            tecla = (document.all) ? e.keyCode :e.which; 
            
            return (tecla!=13); 
        }
</script>
@parent
@endsection 