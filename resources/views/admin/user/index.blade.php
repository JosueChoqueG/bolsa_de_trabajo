@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Usuarios </li>
         
@endsection
 @section('content')
 
<div class="row">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header"> 
        <i class="fa fa-list"></i> Usuarios 
      </div>
      <div class="card-body">
      
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="pull-left">
              @if (permission('users.create'))
              <button id="btnModalOpen" class="btn btn-primary btn-sm  ">
                <span class="fa fa-plus"></span> Nuevo usuario
              </button> 
              @endif  
              <a href="{{ route('users') }}" class="btn btn-light btn-sm">
                <span class="fa fa-refresh"></span> Refrescar página
              </a>
             </div> 
           </div>
          
        </div><!--row-->   
         
        <div class="table-responsive ">
            <table class="table table-hover table-bordered  table-sm" id="tableUser">
            <thead>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Fecha registro</th>
                <th>Opciones</th>
            </thead>
            <tbody>
              
            </tbody>
            
            </table>
        </div>
      </div>
    </div>
  </div>
</div>      
    
</div>
@include('admin.user.partial.modal_register')
@endsection

@section('scripts')

<script src="{{ asset('assets_admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets_admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets_admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/user/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/user/index_jquery.js')}}"></script>

@parent

@endsection 