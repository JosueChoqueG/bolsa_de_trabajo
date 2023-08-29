
@extends('web.layout.template')
    @section('css')
        <link rel="stylesheet" href="{{asset('assets_web/develop_css/general_job_offer.css')}}">
    @parent
    @endsection
 
@section('content')

<section class="about_part section_padding" id="curriculum">
    <div class="container-fluid">
       <div class="row">
           <div class="col-md-2" id="left_content">
               @include('web.layout.submenu_candidate')
           </div>
           <div class="col-md-10" id="rigth_content">
               <div class="row">
                   <div class="col-md-11" id="sub_right">
                       <div class="row">
                           <nav aria-label="breadcrumb" style="width: 100%;">
                               <ol class="breadcrumb" style="background-color: #ffffff;">
                                   <li class="breadcrumb-item"><a href="{{route('employers')}}">Inicio</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">
                                      Perfil
                                   </li>
                               </ol>
                           </nav>
                           <div class="card" style="width: 100%;">
                                <div class="card-body">
                                        <h4 class="card-title"><i class="ti-clipboard "></i><span class="ml-3">Perfil</span></h4>
                                    <form role="form"  method="POST" action="{{ route('updateCandidate') }}"  id="frmRegister"> 
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5><strong>Datos Personales</strong> </h5>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <input type="hidden" value="">
                                                            <label for="field-1" class="">DNI</label> 
                                                        <input type="text" class="form-control "  id="document"  value="{{Session::get('document')}}" name="document" placeholder="Dni " readonly required>
                                                            <em id="document-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="">Nombre</label> 
                                                            <input type="text" class="form-control "  id="name"  name="name" placeholder="Nombre" readonly required>
                                                            <em id="name-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="">Apellido paterno</label> 
                                                            <input type="text" class="form-control " id="first_lastname"   name="first_lastname" placeholder="Apellido paterno" readonly required >
                                                            <em id="first_lastname-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="">Apellido materno</label> 
                                                            <input type="text" class="form-control " id="second_lastname"   name="second_lastname" placeholder="Apellido materno" readonly required>
                                                            <em id="second_lastname-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div> 
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="">Sexo</label> 
                                                            <select name="gender" id="gender" class="form-control " required>
                                                                <option value="">Seleccione</option>
                                                                <option value="M">Masculino</option>
                                                                <option value="F">Femenino</option>
                                                            </select>
                                                            <em id="gender-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="">Fecha de nacimiento</label> 
                                                            <input type="date" class="form-control " id="birthdate"   name="birthdate" placeholder="Ingrese fecha de nacimiento" required >
                                                            <em id="birthdate-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="">Estado civil</label> 
                                                            <select name="civil_status" id="civil_status" class="form-control " required>
                                                                <option value="">Seleccione</option>
                                                                <option value="Soltero(a)">Soltero(a)</option>
                                                                <option value="Conviviente">Conviviente</option>
                                                                <option value="Casado(a)">Casado(a)</option>
                                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                                <option value="Viudo(a)">Viudo(a)</option>
                                                            </select>
                                                            <em id="civil_status-error" class="error invalid-feedback"></em>  
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <img src="{{asset('/img/candidate/photo/default.JPG')}}"  class="img-responsive img-thumbnail" width="150" id="foto"><br>
                                                <label for="field-1" class="">Fotografía <small>(opcional)</small></label> 
                                                <input type="file" id="photo"  data-buttonname="btn-white" class="form-control form-control-sm" name="photo">
                                                <em id="photo-error" class="error invalid-feedback"></em>  
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Limitacíon Física</label> 
                                                    <select name="disability" id="disability" class="form-control " required>
                                                        <option value="">Seleccione</option>
                                                        <option value="Ninguno">Ninguno</option>
                                                        <option value="Para ver">Para ver</option>
                                                        <option value="Para oír">Para oír</option>
                                                        <option value="Para hablar">Para hablar</option>
                                                        <option value="Para usar extremidades">Para usar extremidades</option>
                                                        <option value="Otros">Otros</option>
                                                    </select>
                                                    <em id="disability-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                        </div> 
                                        
                                    </fieldset>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5><strong>Datos de contacto</strong> </h5>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Correo electrónico</label> 
                                                    <input type="text" class="form-control " id="email"   name="email" placeholder="Ingrese email" required>
                                                    <em id="email-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            <div class="col-md-4"> 
                                                <div class="form-group"> 
                                                    <label for="field-2" class="">Nro telef 1.</label> 
                                                        <input type="text" class="form-control " id="first_phone"  name="first_phone" placeholder="Ingrese nro de teléfono" required>
                                                        <em id="first_phone-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            <div class="col-md-4"> 
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Nro telef 2. <small>(opcional)</small></label> 
                                                    <input type="text" class="form-control "  id="second_phone"  name="second_phone" placeholder="Ingrese nro de teléfono " >
                                                    <em id="second_phone-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            
                                        </div>
                                        
                                    </fieldset>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5><strong>Datos académicos</strong> </h5>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                
                                                    <table class="table table-sm table-bordered table-hover">
                                                        <thead>
                                                            <tr id="">
                                                                <th>Escuela</th>
                                                                <th>Código</th>
                                                                {{--  <th>Situacion académica</th>  --}}
                                                                {{-- <th>Semestre de ingreso</th>
                                                                <th>Semestre de egreso</th> --}}
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody id="list_college">
                
                                                        </tbody>
                                                        <tfoot id="footer_template" hidden>
                                                            <tr>
                                                                <td>
                                                                    <select name="" class="form-control form-control-sm item_carrera_id" disabled>
                                                                        <option value="" >Seleccione</option >
                                                                        @foreach ($colleges as $college)
                                                                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"class="form-control form-control-sm item_codigo"  placeholder="Ejm: 101006" disabled >
                                                                </td>
                                                                {{--  <td>
                                                                    <select name="item_situacion[]" class="form-control item_situacion" required>
                                                                        <option value="" >Seleccione</option >
                                                                        <option value="Estudiante">Estudiante</option> 
                                                                        <option value="Egresado"> Egresado</option> 
                                                                        <option value="Graduado">Graduado</option>    
                                                                    </select>
                                                                </td>  --}}
                                                                {{-- <td>
                                                                    <input type="text"  class="form-control form-control-sm item_ingreso" placeholder="Ejm: 2010-1" disabled >
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm item_egreso"  placeholder="Ejm: 2016-1" disabled>
                                                                </td> --}}
                                                            
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="alert alert-danger alert-dismissible" id="alert_college" style="display: none;"  role="alert">
                                                        <p id="msg_college"></p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset> 
                                        <hr>
                                        <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" id="btnSave"> <i class=""></i> Guardar</button>  
                                        </div>
                                    </form>
                                </div>
    
                            </div>
                       </div>
                   </div>
               </div>
               
            </div>	
                
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script src="{{asset('assets_web/develop_js/candidate/update_jquery.js')}}"></script>
<script src="{{asset('assets_web/develop_js/candidate/update_jscript.js')}}"></script>
<script>
        function pulsar(e) 
        { 
            tecla = (document.all) ? e.keyCode :e.which; 
            
            return (tecla!=13); 
        }
</script>
@parent
@endsection