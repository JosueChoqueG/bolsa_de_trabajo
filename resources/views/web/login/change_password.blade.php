
@extends('web.layout.template')
 
@section('content')

<section class="about_part section_padding" id="section_list">
       <div class="container">
           <div class="row">
             
               <div class="offset-md-3 col-md-6">
                    <div class="card">
                           
                            <form action="{{ url('changePassword') }}" method="POST">
                                @csrf
                                  <div class="card-body">
                                        <h4 class="card-title"><i class="ti-lock mr-2"></i><span>Cambiar Contraseña</span> </h5>
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
    </div>
</section>

@endsection
@section('scripts')

@parent
@endsection