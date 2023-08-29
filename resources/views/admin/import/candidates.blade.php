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
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Registro masivo de estudiantes</h5>
            </div>
            <div class="card-body">
                <div class="row mt-2 ">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <div class="">
                                {{-- <button class="btn btn-primary btn-sm  " id="btnViewRegister" ><span class="fa fa-plus"></span> Nuevo registro</button> --}}
                                <a href="{{url('admin/imports')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                            </div>
                        </div> 
                    </div>
                </div><!--row-->

                <div class="row mt-2">
                    <div class="col-md-12">
                        <form action="{{  url('admin/imports')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Archivo xls</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary"> <i class="fa fa-upload"></i> Cargar datos </button>
                        </form>
                    </div>
                </div>
            </div> 
		</div>
	</div>			
</div>

@endsection

@section('scripts')
{{-- <script src="{{asset('assets_admin/develop_js/employer/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/employer/index_jquery.js')}}"></script> --}}
<script>
        function pulsar(e) 
        { 
            tecla = (document.all) ? e.keyCode :e.which; 
            
            return (tecla!=13); 
        }
</script>
@parent
@endsection 