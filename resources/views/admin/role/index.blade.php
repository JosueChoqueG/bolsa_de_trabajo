@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Roles </li>
         
@endsection
 @section('content')
 
<div class="row">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header"> <i class="fa fa-list">
        </i> Roles de usuario 
      </div>
      <div class="card-body">
      
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="pull-left">
              @if (permission('roles.create'))
              <a href="{{ route('roles.create')}}" class="btn btn-primary btn-sm  ">
                <span class="fa fa-plus"></span> Nuevo rol
              </a>   
              @endif
              <a href="{{ route('roles') }}" class="btn btn-light btn-sm">
                <span class="fa fa-refresh"></span> Refrescar página
              </a>
             </div> 
           </div>
          
        </div><!--row-->   
         
        <div class="table-responsive ">
            <table class="table table-hover table-bordered  table-sm" id="table_role">
            <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr id="{{ $role->id }}">
                    <td>{{$role->name}}</td>
                    <td>{{$role->description}}</td>
                    <td>
                    @if (permission('roles.update'))
                    <a href="{{ route('roles.update',$role->id) }}"  title="Editar Rol" class="btn btn-square btn-xs btn-light"><i class="fa fa-edit  " ></i> Editar</a>
                    @endif
                    @if (permission('roles.delete'))
                    <button title="Eliminar Rol" class="btn btn-square btn-xs btn-danger delete"><i class="fa fa-trash " ></i> Eliminar</button>
                    @endif  
                  </td>
                </tr>
                @endforeach
            </tbody>
            
            </table>
        </div>
      </div>
    </div>
  </div>
</div>      
    
</div>
@endsection

@section('scripts')

<script src="{{ asset('assets_admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets_admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets_admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/role/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/role/index_jquery.js')}}"></script>

@parent

@endsection 