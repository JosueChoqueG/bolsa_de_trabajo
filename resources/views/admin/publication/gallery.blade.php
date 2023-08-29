@extends('admin.layout.template')
@section('breadcrumb')
   
<li class="breadcrumb-item">
    <a href="{{url('panel')}}">Inicio</a>
</li>
<li class="breadcrumb-item active">
    <a href="{{url('publications')}}">Mis publicaciones</a>
</li>
<li class="breadcrumb-item active">{{$publication->title}} </li>
     
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-picture icons fa-lg"></i> Galería de imagenes</h5>
            </div>
            <div class="card-body">
                
                    
                <ul class="list-group ">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4"><button type="button" class=" btn btn-xs btn-primary btn-square" id="a_path_logo" ><i class='fa fa-plus-square'></i> Añadir imagen</button></div>
                            <div class="col-md-8">
                                <div class="float-right">
                                        <button type="button" class="btn btn-default btn-sm btn-list"  > <i class="fa fa-reply"></i>   Volver</button> 
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item li_image">
                        <div class="row">
                            @foreach ($images as $image)
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 id_image" id="{{$image->id}}">
                                    <div class="card mb-4 shadow-sm">
                                        <img src="{{asset('img/resource/image/'.$image->path)}}" alt="..." class="img-fluid" >
                                        
                                        <div class="card-body" style="padding: 5px;">
                                            <div class="">
                                                <h6 class="text-success image_name" id="{{$image->path}}">{{$image->path}}</h6>
                                            </div>

                                            <div class="text-center">
                                                <button type="button" class="delete_image btn btn-xs btn-danger btn-block"><i class="icon-trash"></i> <span>Quitar imagen de la Galería</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row ">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="text-muted mt-3"> Monstrando: {{$images->total()}} registros</p>
                                    </div>
                                    <div class="col-md-7">
                                        {{$images->appends(Request::only([]))->render()}}  
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </li>
                </ul>
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
                    </div>
                </div> 
            </div>
            <form class="navbar-form " id="frmSubmit">
                <div class="modal-footer">
                    <label for="" class=" col-form-label">Nombre del archivo</label>
                        <input type="text" class="form-control" id="name_modal" name="path" placeholder="nombre del archivo" readonly style="width: 50%;">
                        <input class="form-control" type="hidden" id="resource_id" name="resource_id" class="">
                        <input type="hidden" id="publication_id" name="publication_id" value="{{$publication->id}}">
                    <div class="">
                        <button class="btn btn-square btn-block btn-success btn-sm" type="submit" id="btn_usar">Agregar a la galería</button>
                    </div>
                    <div>
                        <a class="btn btn-square btn-block btn-dark btn-sm" type="button" id="btn_cancelar">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets_admin/develop_js/images/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/images/index_jquery.js')}}"></script>
@parent
@endsection 