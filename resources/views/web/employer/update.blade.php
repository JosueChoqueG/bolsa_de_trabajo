
@extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/job_offer.css')}}">
    @parent
    @endsection
@section('content')

<section class="about_part section_padding" id="curriculum">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="left_content">
                @include('web.layout.submenu_employer')
            </div>
            <div class="col-md-10" id="rigth_content">
                <div class="row">
                    <div class="col-md-11" id="sub_right">
                        <div class="row">
                            <nav aria-label="breadcrumb" style="width: 100%;">
                                <ol class="breadcrumb" style="background-color: #ffffff;">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item">Perfil empresarial</li>
                                </ol>
                            </nav>
                            <div class="card" style="width: 100%;">
                                <form role="form"  method="POST" action="{{ route('updateEmployer') }}"  id="frmRegister"> 
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="ti-clipboard "></i><span class="ml-3">Perfil Empresarial</span></h4>
                                        <input type="hidden" name="id"  value="{{Session::get('employer_id')}}" id="id">
                                        <fieldset class="mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                        <h5><strong>Datos de la empresa</strong> </h5>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-md-2"> 
                                                    <div class="form-group"> 
                                                        <label for="field-2" class="">Ruc</label> 
                                                    <input type="text" class="form-control " id="ruc"  value="{{Session::get('ruc')}}" name="ruc" placeholder=" " disabled>
                                                            
                                                            <em id="ruc-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-5"> 
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Razón social</label> 
                                                        <input type="text" class="form-control "  id="name"  name="name" placeholder=" " disabled>
                                                        <em id="name-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-5"> 
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Nombre comercial</label> 
                                                        <input type="text" class="form-control " id="tradename"   name="tradename" placeholder="" disabled>
                                                        <em id="tradename-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div> 
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Dirección</label> 
                                                        <input type="text" class="form-control " id="address"   name="address" placeholder="Ingrese dirección" >
                                                        <em id="address-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Sector</label> 
                                                        <select name="sector_id" id="sector_id" class="form-control form-control-sm">
                                                            <option value="">Selecione</option>
                                                            @foreach ($sectors as $sector)
                                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <em id="sector_id-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Correo electrónico</label> 
                                                        <input type="text" class="form-control " id="email"   name="email" placeholder="Ingrese email" >
                                                        <em id="email-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Página web</label> 
                                                        <input type="text" class="form-control " id="web_page"   name="web_page" placeholder="Url de pagina web (opcional)" >
                                                        <em id="web_page-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                    <img src="{{asset('/img/employer/logo/default.JPG')}}"  class="img-responsive img-thumbnail" width="120" id="foto"><br>
                                                    <label for="field-1" class="">Logo de la empresa</label> 
                                                    <input type="file" id="logo"  data-buttonname="btn-white" class="form-control input-sm" name="logo">
                                                    <em id="logo-error" class="error invalid-feedback"></em>  
                    
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <label for="field-1" class="">Descripción de la empresa</label> 
                                                    <textarea class="form-control form-control-sm" name="description" id="description" cols="5" rows="5" maxlength="100" placeholder="Ejm: Empresa dedicada a la producción de alimentos, Persona natural ... etc."></textarea>
                                                    <em id="description-error" class="error invalid-feedback"></em>  
                                                </div>
                                                
                                            </div> 
                                        </fieldset>
                                        <fieldset class="mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                        <h5><strong>Datos de contacto</strong> </h5>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                            
                                                <div class="col-md-6"> 
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Nombres</label> 
                                                        <input type="text" class="form-control "  id="contact_name"  name="contact_name" placeholder="Ingrese nombres " >
                                                        <em id="contact_name-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Apellidos</label> 
                                                        <input type="text" class="form-control " id="contact_lastname"   name="contact_lastname" placeholder="Ingrese apellidos" >
                                                        <em id="contact_lastname-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"> 
                                                    <div class="form-group"> 
                                                        <label for="field-2" class="">Cargo</label> 
                                                            <input type="text" class="form-control " id="contact_role"  name="contact_role" placeholder="ingrese el cargo que tiene en la empresa " >
                                                            <em id="contact_role-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-4"> 
                                                    <div class="form-group"> 
                                                        <label for="field-2" class="">Nro telef 1.</label> 
                                                            <input type="text" class="form-control " id="contact_first_phone"  name="contact_first_phone" placeholder="Ingrese nro de teléfono " >
                                                            
                                                            <em id="contact_first_phone-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                <div class="col-md-4"> 
                                                    <div class="form-group"> 
                                                        <label for="field-1" class="">Nro telef 2. <small>(opcional)</small></label> 
                                                        <input type="text" class="form-control "  id="contact_second_phone"  name="contact_second_phone" placeholder="Ingrese nro de teléfono " >
                                                        <em id="contact_second_phone-error" class="error invalid-feedback"></em>  
                                                    </div> 
                                                </div>
                                                
                                            </div>
                                            
                                        </fieldset>
                                        <hr>
                                        <div class="card-footer text-right"> 
                                            <a href="{{ url('/') }}" class="btn btn-secondary btn-sm"> Volver</a> 
                                            <button type="submit" class="btn btn-primary btn-sm" id="btnSave"> <i class=""></i> Guardar</button>  
                                        </div> 
                                    
                                    </div>
                                </form>
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
<script src="{{asset('assets_web/develop_js/employer/register/update_jquery.js')}}"></script>
<script src="{{asset('assets_web/develop_js/employer/register/update_jscript.js')}}"></script>
@parent
@endsection