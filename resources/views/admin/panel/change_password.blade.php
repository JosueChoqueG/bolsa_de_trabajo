@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Cambiar contraseña </li>
         
@endsection
 @section('content')
 
<div class="row">
  <div class=" offset-md-4 col-md-4 ">
    <div class="card">
      <div class="card-header"> <i class="fa fa-list">
        </i> Cambiar contraseña 
      </div>
      <form action="{{ url('admin/changePassword') }}" method="POST">
          @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Contraseña actual</label>
                    <input type="password" name="current_password" class="form-control"  placeholder="ingrese contraseña actual" required="required" maxlength="50">
                    <em class="text-danger">{{ @$errors->first('current_password') }}</em>
                </div>
                <div class="form-group">
                    <label>Contraseña nueva</label>
                    <input type="password" name="password" class="form-control"  placeholder="ingrese nueva contraseña" required="required" maxlength="50">
                    <em class="text-danger">{{ @$errors->first('current_password') }}</em>
                </div>
                <div class="form-group">
                    <label>Repita nueva</label>
                    <input type="password" name="repeat_password" class="form-control"  placeholder="repita nueva contraseña" required="required" maxlength="50">
                    <em class="text-danger">{{ @$errors->first('current_password') }}</em>
                </div> 
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif   
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary "> Guardar cambios</button>
            </div>
      </form>
     
    </div>
  </div>
</div>      
    
</div>
@endsection

@section('scripts')

@parent

@endsection 