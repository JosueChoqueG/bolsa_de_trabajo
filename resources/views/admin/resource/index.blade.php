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
                <h5 class="header-title "> <i class="icon-emotsmile icons fa-lg"></i>Recursos multimedia</h5>
            </div>
            <div class="card-body">
                 @if (permission('resources.create'))
                <a  href="#" id="a_add">Añadir Recurso</a>
                @endif
                <div class="row mt-2 ">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Imagenes</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="pdf-tab" data-toggle="tab" href="#pdf" role="tab" aria-controls="pdf" aria-selected="false">PDF</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false">Doc</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
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
                                <li class="list-group-item resource" id="li_image">
                                   
                                </li>
                            </ul>
                            <p style="visibility: hidden;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi tempore sapiente quo architecto ex consequatur magnam, fugit quos facere. Corporis placeat dolores, nam assumenda atque voluptas eaque debitis sed cumque.</p>
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
                                <li class="list-group-item resource" id="li_pdf">  
                                    
                                </li>
                                <p style="visibility: hidden;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi tempore sapiente quo architecto ex consequatur magnam, fugit quos facere. Corporis placeat dolores, nam assumenda atque voluptas eaque debitis sed cumque.</p>
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
                                <li class="list-group-item resource" id='li_doc'>
                                    
                                </li>
                                <p style="visibility: hidden;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi tempore sapiente quo architecto ex consequatur magnam, fugit quos facere. Corporis placeat dolores, nam assumenda atque voluptas eaque debitis sed cumque.</p>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div> 
		</div>
	</div>			
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal_resource">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Añadir Nuevo Recurso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="{{ url('admin/resources/create') }}" id="frmResou" enctype="multipart/form-data" method="post">
            @csrf    
            <div class="form-group text-center ">
                    <img src="{{asset('/img/employer/logo/default.JPG')}}"  class="img-responsive img-thumbnail" width="120" id="foto">
                    <input type="file" id="path"  data-buttonname="btn-white" class="form-control input-sm" name="archivo" required>
                    <em id="path-error" class="error invalid-feedback"></em><br>
                </div>
            @if ($errors->has('archivo'))
                <div class="alert alert-danger"> {{ $errors->first('archivo') }}</div>
            @endif
               
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-default" id="btn_cancelar" >Cancelar</a>
            <button type="submit" class="btn btn-primary" id="btn_cancelar">Guardar</button>
        </div>
        </form> 
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets_admin/develop_js/resource/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/resource/index_jquery.js')}}"></script>
@parent
@endsection 