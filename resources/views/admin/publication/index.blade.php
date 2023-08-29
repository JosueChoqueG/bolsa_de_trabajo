@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Mis publicaciones </li>
         
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Mis publicaciones</h5>
            </div>
            <div class="card-body">
                <div class="row mt-2 ">
                    <div class="col-md-6">
                        <div class="pull-left">
                            <div class="">
                                @if (permission('publications.create'))
                                <button class="btn btn-primary btn-sm  " id="btnViewRegister" ><span class="fa fa-plus"></span> Nuevo registro</button>
                                @endif
                                <a href="{{route('publications')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <form class="navbar-form " method="GET" action="{{route('publications')}}" id="frmBuscar" >
                            <div class="input-group mb-3">
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
                                    <th style="width:38%">Título</th>
                                    <th style="width:15%">usuario</th>          					          				
                                    <th style="width:7%">fecha</th>
                                    <th style="width:5%">Estado</th>
                                    <th style="width:10%">Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="table_body" >
                                
                                @foreach($publications as $publication)
                                <tr id="{{$publication->id }}">
                                    <td id="td_title">{{$publication->title}}</td>
                                    <td>{{$publication->user->name.' '.$publication->user->last_name}}</td>
                                    @php
                                        $dt     = new DateTime($publication->created_at);
                                        $date   = $dt->format('d/m/Y');
                                    @endphp
                                    <td>{{$date}}</td>
                                   
                                    <td> 
                                        @if ($publication->status == 0)
                                            <span class="badge badge-secondary">Cerrado</span>
                                        @elseif($publication->status == 1)
                                        <span class="badge badge-success">Publicado</span>
                                        @endif
                                    </td>
                                    <td> 
                                       {{$publication->type}}
                                    </td>
                                    <td>	
                                        @if (permission('publications.update'))
                                        <button type="button" class=" btn btn-xs btn-primary btn-square edit" ><i class='fa fa-edit'></i> Editar</button>                                       
                                        @endif
                                        @if (permission('publications.delete'))
                                        <button type="button" class=" btn btn-xs btn-danger btn-square delete" ><i class='fa fa-trash'></i> Eliminar</button>                                       
                                        @endif
                                        @if($publication->type == 'Evento')
                                            @if (permission('publications.images'))
                                            <a href="{{route('publications.images',$publication->id)}}" type="button" class=" btn btn-xs btn-dark btn-square delete" ><i class='fa fa-file-image-o'></i> Añadir Galería</a>                                       
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div>
                        <div class="float-left">
                            Mostrando de {{ $publications->firstItem()}} al  {{ $publications->lastItem()}} de  {{ $publications->total()}} registros 
                        </div>
                        <div class="float-right">
                            {{$publications->appends(Request::only(['title']))->render()}}   
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
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Registro de publicaciones</h5>
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
                        <legend>Datos de la publicación :</legend>
                        <div class="form-row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Título de la publicación*</label>
                                    <input type="text" class="form-control" id="title" placeholder="Titulo de la publicación" name="title" value="" required>
                                    <em id="title-error" class="error invalid-feedback messages"></em> 
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Tipo de publicación*</label>
                                        <select type="text" class="form-control" id="type"  name="type" required>
                                            <option value="">--Seleccione--</option>
                                            <option value="Evento">Evento</option>
                                            <option value="Artículo de Interés" >Artículo de Interés</option>
                                            <option value="Orientación">Orientación</option>
                                        </select>
                                        <em id="type-error" class="error invalid-feedback messages"></em> 
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Estado*</label>
                                        <select  class="form-control" id="status"  name="status" required>
                                            <option value="">--Seleccione--</option>
                                            <option value="1">Publicado</option>
                                            <option value="0" >Cerrado</option>
                                        </select>
                                        <em id="status-error" class="error invalid-feedback messages"></em> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-5 text-center">
                                <label >Imagen principal*</label><br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <a class="btn btn-outline-secondary" type="button" id="a_path_images">Seleccionar</a>
                                        </div>
                                        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="path_image" name="path_image">
                                  </div>
                                <img src="{{asset('/img/employer/logo/default.JPG')}}"  class="img-responsive img-thumbnail mt-2" width="150" id="foto">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Descripción*</label>
                                <textarea type="text" class="form-control" id="description"  name="description" required>
                                    
                                </textarea>
                                <em id="description-error" class="error invalid-feedback messages"></em> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Fecha del evento<small style="color:cadetblue;">(Aplica para eventos)</small></label>
                                <input type="date" class="form-control" id="event_date" placeholder="Nro Vacantes" name="event_date" value="" >
                                <em id="event_date-error" class="error invalid-feedback messages"></em> 
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-6" id="div_salary_min">
                                        <label>Hora de Inicio<small style="color:cadetblue;">(Aplica para eventos)</small></label>
                                        <input type="time" class="form-control " id="start_time"  name="start_time"  value="">
                                        <em id="start_time-error" class="error invalid-feedback messages"></em> 
                                    </div>
                                    <div class="form-group col-md-6" id="div_salary_max">
                                        <label>Hora de Fin<small style="color:cadetblue;">(Aplica para eventos)</small></label>
                                        <input type="time" class="form-control " id="end_time"  name="end_time" value="">
                                        <em id="end_time-error" class="error invalid-feedback messages"></em> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Costo<small style="color:cadetblue;">(Aplica para eventos)</small></label>
                                <input type="Number" class="form-control" id="cost" placeholder="Costo del evento" name="cost" value="">
                                <em id="cost-error" class="error invalid-feedback messages"></em> 
                            </div>
                            
                        </div>  
                        
                        {{-- <div class="form-row">
                        
                            <div class="form-group col-md-4 text-center">
                                <label >PDF</label><br>
                                <img src="{{asset('/img/resource/doc/doc-file-format-symbol.png')}}"  class="img-responsive img-thumbnail" width="150" height="140" id="foto1"><br>
                                <a class="btn btn-square btn-warning mt-2" type="button" id="a_path_pdf">
                                    <i class="fa fa-plus"></i>&nbsp;Seleccionar archivo
                                </a><br>
                                <input type="text"  class="mt-2" value="" name="path_pdf" id="path_pdf" readonly >
                                <em id="path_pdf-error" class="error invalid-feedback messages"></em> 
                            </div> 
                            <div class="form-group col-md-4 text-center">
                                <label >DOC</label><br>
                                <img src="{{asset('/img/resource/pdf/pdf-file.png')}}"  class="img-responsive img-thumbnail" width="150" height="140" id="foto2"><br>
                                <a class="btn btn-square btn-warning mt-2" type="button" id="a_path_doc">
                                    <i class="fa fa-plus"></i>&nbsp;Seleccionar archivo
                                </a><br>
                                <label for="" id="name_doc"></label>
                                <input type="text"  class="mt-2" value="" name="path_doc" id="path_doc" readonly >
                                <em id="path_doc-error" class="error invalid-feedback messages"></em> 
                            </div> 
                        </div> --}}
                    </fieldset>    
                       
                </div>
                <div class="card-footer"> 
                    <button type="button" class="btn btn-default btn-sm btn-list"  >Cancelar</button> 
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSave"> <i class=""></i> Guardar</button>  
                </div> 
            </form>
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
                <input type="hidden" name="type_path" id="type_path">

                <div class="row mt-2 ">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" id="nav_image">
                            <a class="nav-link active" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Imagenes</a>
                        </li>
                        <li class="nav-item" id="nav_pdf">
                            <a class="nav-link" id="pdf-tab" data-toggle="tab" href="#pdf" role="tab" aria-controls="pdf" aria-selected="false">PDF</a>
                        </li>
                        <li class="nav-item" id="nav_doc">
                            <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false">Doc</a>
                        </li>
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


@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{asset('assets_admin/develop_js/publication/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/publication/index_jquery.js')}}"></script>
<script>
        function pulsar(e) 
        { 
            tecla = (document.all) ? e.keyCode :e.which; 
            
            return (tecla!=13); 
        }
</script>
@parent
@endsection 