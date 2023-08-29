@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/rol')}}">Rol</a>
    </li>
    <li class="breadcrumb-item active">Registrar/editar Rol </li>

         
@endsection
 @section('content')
 
<div class="row">
  <div class="col-md-10 offset-md-1 ">
    <div class="card">
      <div class="card-header"> <i class="fa fa-list">
        </i> Rol de usuario
      </div>
      <div class="card-body">
         <form method="POST" action="{{ url($url)}}">
           {{csrf_field()}}
          <input type="hidden" name="role_id" value="{{old('role_id',@$role->id)}}">
           <div class="form-group">
             <label>Nombre</label>
             <input type="text" name="name" class="form-control" value="{{old('name',@$role->name)}}"  placeholder="Ingrese un nombre para el Rol de usuario" required="required" maxlength="30">
             <em class="text-danger">{{ @$errors->first('name') }}</em>
           </div>
             <label>Descripción (opcional)</label>
             <textarea placeholder="Ingrese una breve descripción para el rol de usuario" name="description" class="form-control"  rows="3" cols="40" maxlength="100">{{old('description',@$role->description)}}</textarea>
             <em class="text-danger">{{ @$errors->first('description') }}</em>
          <hr>
          <div class="row">
            <div class="col-md-12" >
                 <h4 class="text-dark">Lista de permisos</h4>
                 <label ><input type="checkbox" name="all" value="1"  onClick="toggle(this)"> Seleccionar todo </label><br>
                <div class="row">
                       
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        @foreach ($routes as $key => $route)
                            @if($key<36)
                                <li @if($route->level==1) style="padding-left: 0px; font-weight:bold;" @else style="padding-left: 30px;" @endif>
                                    <label><input type="checkbox" name="routes[]" id="routes" value="{{$route->id}}"  {{ (is_array(old('routes',@$routesAsigned)) and in_array($route->id, old('routes',@$routesAsigned))) ? 'checked' : '' }} > {{ $route->name}} <em class="text-muted"> ({{$route->description}})</em></label>
                                </li>        
                            @endif
                        @endforeach     
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        @foreach ($routes as $key => $route)
                            @if($key>=36)
                                <li @if($route->level==1) style="padding-left: 0px; font-weight:bold;" @else style="padding-left: 30px;" @endif>
                                    <label><input type="checkbox" name="routes[]" value="{{$route->id}}"  {{ (is_array(old('routes',@$routesAsigned)) and in_array($route->id, old('routes',@$routesAsigned))) ? 'checked' : '' }} > {{ $route->name}} <em class="text-muted"> ({{$route->description}})</em></label>
                                </li>        
                            @endif
                        @endforeach     
                    </ul>
                </div>
            </div>
            </div>
        </div><!--row--> 
          <div class="modal-footer">
              <a href="{{ route('roles')}}" class="btn btn-sm btn-secondary"> Cancelar</a>
              <button type="submit" class="btn btn-primary btn-sm">Guardar</button>

          </div>
           </form> 
        </div>
         
      </div>
    </div>
  </div>
</div>      
    
</div>
@endsection

@section('scripts')
<script>
    function toggle(source) {
        
       let  checkboxes = document.getElementsByName('routes[]');
     
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      
      }
</script>
@parent

@endsection 