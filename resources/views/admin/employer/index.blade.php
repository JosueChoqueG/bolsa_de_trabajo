@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Empleadores</li>
         
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Empleadores</h5>
            </div>
            <div class="card-body">
                <div class="row mt-2 ">
                    <div class="col-md-6">
                        <div class="pull-left">
                            <div class="">
                                @if (permission('employers.create'))
                                <button class="btn btn-primary btn-sm  " id="btnViewRegister" ><span class="fa fa-plus"></span> Nuevo registro</button>
                                @endif
                                <a href="{{url('admin/employers')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <form class="navbar-form " method="GET" action="{{ url('admin/employers')}}" id="frmBuscar" >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select name="slc_search" id="slc_search" class="form-control form-control-sm" >
                                        <option value="ruc"{{ $slc_search =='ruc'?'selected':'' }}>Ruc</option>
                                        <option value="name" {{ $slc_search =='name'?'selected':'' }}>Nombre</option>
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
                            <thead style="cursor:pointer">
                                <tr>
                                    <th>Ruc</th>
                                    <th>Nombre</th>
                                    <th>Nombre comercial</th>          					          				
                                    <th>Sector</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="list_employers" >
                                @foreach($employers as $employer)
                                <tr id="{{ $employer->id }}">
                                    <td>{{$employer->ruc}}</td>
                                    <td>{{$employer->name}}</td>
                                    <td>{{$employer->tradename}}</td>
                                    <td>{{$employer->sector->name}}</td>
                                    <td> 
                                        @if ($employer->status == 'Inactivo')
                                            <span class="badge badge-secondary">Inactivo</span>
                                        @elseif($employer->status == 'Activo')
                                        <span class="badge badge-success">Activo</span>
                                        @else  
                                        <span class="badge badge-warning">En revisión</span>  
                                        @endif
                                    </td>
                                    <td>	
                                        @if (permission('employers.update'))
                                        <button type="button" class=" btn btn-xs btn-primary btn-square edit" ><i class='fa fa-edit'></i> Editar</button>
                                        @endif
                                        @if (permission('employers.delete'))
                                        <button type="button" class=" btn btn-xs btn-danger btn-square delete" ><i class='fa fa-trash'></i> Eliminar</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div>
                        <div class="float-left">
                            Mostrando de {{ $employers->firstItem()}} al  {{ $employers->lastItem()}} de  {{ $employers->total()}} registros 
                        </div>
                        <div class="float-right">
                            {{$employers->appends(Request::only(['ruc','name']))->render()}}   
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
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Registro Empleadores</h5>
            </div>
              
                <div class="card-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <form class="navbar-form " method="POST" id="frmQueryRuc">
                                <div class="input-group mb-3 " id="group_search">
                                   
                                    <input type="search" class="form-control form-control-sm" placeholder="ingrese RUC" name="search_ruc" id="search_ruc">
                                   
                                    <div class="input-group-append" id="button-addon4">
                                        <button type="submit" id="btn_search_ruc" class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                    </div>
                                    <em id="search_ruc-error" class="error invalid-feedback"></em> 
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="float-right">
                                    <button type="button" class="btn btn-default btn-sm btn-list"  > <i class="fa fa-reply"></i>   Volver</button> 
                            </div>
                        </div>
                    </div>
                    <form role="form"  method="POST" action=""  id="frmRegister"> 
                    <fieldset>
                        <legend>Datos de empresa:</legend>
                        
                        <div class="row">
                            
                            <div class="col-md-2"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="">Ruc</label> 
                                        <input type="text" class="form-control " id="ruc" onkeypress="return pulsar(event)" name="ruc" placeholder=" ingrese ruc" >
                                        
                                        <em id="ruc-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-5"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Razón social</label> 
                                    <input type="text" class="form-control " onkeypress="return pulsar(event)" id="name"  name="name" placeholder=" ingrese razón social" >
                                    <em id="name-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-5"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Nombre comercial</label> 
                                    <input type="text" class="form-control " id="tradename" onkeypress="return pulsar(event)"  name="tradename" placeholder=" ingrese nombre comercial (opcional)" >
                                    <em id="tradename-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Dirección</label> 
                                    <input type="text" class="form-control " id="address" onkeypress="return pulsar(event)"  name="address" placeholder="Ingrese dirección" >
                                    <em id="address-error" class="error invalid-feedback"></em>  
                                </div> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Sector</label> 
                                    <select name="sector_id" id="sector_id" class="form-control form-control-sm">
                                        <option value="">Selecione</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                        @endforeach
                                    </select>
                                    <em id="sector_id-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Actividad(es) Economica(s)</label> 
                                    <ul id="economic_activity">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Correo electrónico</label> 
                                    <input type="text" class="form-control " id="email" onkeypress="return pulsar(event)"  name="email" placeholder="Ingrese email" >
                                    <em id="email-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Página web</label> 
                                    <input type="text" class="form-control " id="web_page" onkeypress="return pulsar(event)"  name="web_page" placeholder="Url de pagina web (opcional)" >
                                    <em id="web_page-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                
                                <img src="{{asset('/img/employer/logo/default.JPG')}}"  class="img-responsive img-thumbnail" width="120" id="foto"><br>
                                <label for="field-1" class="">Logo de la empresa</label> 
                                <input type="file" id="logo"  data-buttonname="btn-white" class="form-control input-sm" name="logo">
                                <em id="logo-error" class="error invalid-feedback"></em>  

                            </div>
            
                            <div class="col-md-6">
                                <label for="field-1" class="">Descripción de la empresa</label> 
                                <textarea class="form-control form-control-sm" name="description" id="description" cols="6" rows="6" maxlength="300" placeholder="Ejm: Empresa dedicada a la producción de alimentos, Persona natural ... etc."></textarea>
                                <em id="description-error" class="error invalid-feedback"></em>  
                            </div>
                            
                        </div> 
                    </fieldset>
                    <fieldset>
                        <legend>Datos de contacto:</legend>
                        
                        <div class="row">
                        
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Nombres</label> 
                                    <input type="text" class="form-control " onkeypress="return pulsar(event)" id="contact_name"  name="contact_name" placeholder="Ingrese nombres " >
                                    <em id="contact_name-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Apellidos</label> 
                                    <input type="text" class="form-control " id="contact_lastname" onkeypress="return pulsar(event)"  name="contact_lastname" placeholder="Ingrese apellidos" >
                                    <em id="contact_lastname-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="">Cargo</label> 
                                        <input type="text" class="form-control " id="contact_role" onkeypress="return pulsar(event)" name="contact_role" placeholder="ingrese el cargo que tiene en la empresa " >
                                        <em id="contact_role-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="">Nro telef 1.</label> 
                                        <input type="text" class="form-control " id="contact_first_phone" onkeypress="return pulsar(event)" name="contact_first_phone" placeholder="Ingrese nro de teléfono " >
                                        
                                        <em id="contact_first_phone-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="">Nro telef 2. <small>(opcional)</small></label> 
                                    <input type="text" class="form-control " onkeypress="return pulsar(event)" id="contact_second_phone"  name="contact_second_phone" placeholder="Ingrese nro de teléfono " >
                                    <em id="contact_second_phone-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            
                        </div>
                        
                    </fieldset>
                    <fieldset>
                        <legend>Datos de Acceso:</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="field-1" class="">Estado</label> 
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="En revisión">En revisión</option>
                                        <option value="Inactivo">Inactivo</option>
                                        <option value="Activo">Activo</option>
                                    </select>
                                    <em id="status-error" class="error invalid-feedback"></em>  
                                </div> 
                            </div>
                            {{--  <div class="col-md-6">
                                <button  type="button" class="btn btn-outline-warning mt-4 ">Resetear Contraseña</button>
                            </div>  --}}
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
<script src="{{asset('assets_admin/develop_js/employer/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/employer/index_jquery.js')}}"></script>
<script>
        function pulsar(e) 
        { 
            tecla = (document.all) ? e.keyCode :e.which; 
            
            return (tecla!=13); 
        }
</script>
@parent
@endsection 