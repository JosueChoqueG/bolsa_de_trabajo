<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BTUNAMBA</title>
    <link rel="icon" href="{{asset('img/principal/logo.png')}}">

    <link rel="stylesheet" href="{{asset('assets_web/develop_css/principal.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/register.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/login.css')}}">
    <link href="{{asset('assets_admin/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/simple-line-icons.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets_web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/flaticon.css')}}">
    <link href="{{ asset('assets_admin/css/toastr2.min.css')}}"rel='stylesheet'type='text/css'> 
    <link rel="stylesheet" href="{{asset('assets_web/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets_admin/plugins/select2/dist/css/select2.min.css')}}" type='text/css' >
    <link rel="stylesheet" href="{{asset('assets_web/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets_admin/plugins/sweetalert/css/sweetalert.css') }}"/>
    <link rel="stylesheet" href="{{asset('assets_web/css/custom.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    @section('css')
    @show 
</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row mt-5 mb-5" id="content_register" >
            <div class="col-md-12">
                <div class="card" >
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('img/login/registro5.jpg')}}" alt="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="col-md-12 text-center">
                                    <a href="{{route('home')}}">
                                        <img src="{{ asset('img/login/unamba.png')}}" style="height: 67px;"  id="logo_home"> 
                                    </a>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h3>Registro de Empresas y/o Entidades</h3>
                                    </div>
                                </div>
                                <hr>
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form class="navbar-form" method="POST" id="frmQueryRuc">
                                            <div class="input-group mb-3 " id="group_search">
                                                <input type="search" class="form-control form-control-sm" placeholder="ingrese RUC" name="search_ruc" id="search_ruc">
                                                
                                                <div class="input-group-append" id="button-addon4">
                                                    <button type="submit" id="btn_search_ruc" class="btn btn-light btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button> 
                                                </div>
                                                <em id="search_ruc-error" class="error invalid-feedback"></em> 
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="float-right">
                                        </div>
                                    </div>
                                </div>
                                <form role="form"  method="POST" action="{{ route('registerEmployer') }}"  id="frmRegister"> 
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div class="form-group"> 
                                                    <label for="field-2" class="">Ruc*</label> 
                                                    <input type="text" class="form-control " id="ruc"  value="" name="ruc" placeholder=" " readonly>
                                                    <em id="ruc-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            
                                            <div class="col-md-6"> 
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Razón social*</label> 
                                                    <input type="text" class="form-control "  id="name"  name="name" placeholder=" " readonly>
                                                    <em id="name-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Nombre comercial*</label> 
                                                    <input type="text" class="form-control " id="tradename"   name="tradename" placeholder="" readonly>
                                                    <em id="tradename-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Dirección*</label> 
                                                    <input type="text" class="form-control " id="address"   name="address" placeholder="Ingrese dirección" required >
                                                    <em id="address-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" class="form-control " id="economic_activity"   name="economic_activity" >   
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Sector*</label> 
                                                    <select name="sector_id" id="sector_id" class="form-control form-control-sm" required>
                                                        <option value="">Selecione</option>
                                                        @foreach ($sectors as $sector)
                                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <em id="sector_id-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Correo electrónico*</label> 
                                                    <input type="text" class="form-control " id="email"   name="email" placeholder="Ingrese email" required >
                                                    <em id="email-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Página web</label> 
                                                    <input type="text" class="form-control " id="web_page"   name="web_page" placeholder="Url de pagina web (opcional)" >
                                                    <em id="web_page-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                        </div> 
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <img src="{{asset('/img/employer/logo/default.JPG')}}"  class="img-responsive img-thumbnail" width="120" id="foto"><br>
                                                <label for="field-1" class="">Logo de la empresa</label> 
                                                <input type="file" id="logo"  data-buttonname="btn-white" class="form-control input-sm" name="logo">
                                                <em id="logo-error" class="error invalid-feedback"></em>  
                
                                            </div>
                            
                                            <div class="col-md-6">
                                                <label for="field-1" class="">Descripción de la empresa*</label> 
                                                <textarea class="form-control form-control-sm" name="description" id="description" cols="6" rows="6" maxlength="300" placeholder="Ejm: Empresa dedicada a la producción de alimentos, Persona natural ... etc."></textarea>
                                                <em id="description-error" class="error invalid-feedback"></em>  
                                            </div>
                                            
                                        </div> 
                                        <p class="mt-3"><strong>INFORMACIÓN DEL CONTACTO</strong> </p>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Nombres*</label> 
                                                    <input type="text" class="form-control "  id="contact_name"  name="contact_name" placeholder="Ingrese nombres " required>
                                                    <em id="contact_name-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="form-group"> 
                                                    <label for="field-1" class="">Apellidos*</label> 
                                                    <input type="text" class="form-control " id="contact_lastname"   name="contact_lastname" placeholder="Ingrese apellidos" required >
                                                    <em id="contact_lastname-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"> 
                                                <div class="form-group"> 
                                                    <label for="field-2" class="">Cargo*</label> 
                                                        <input type="text" class="form-control " id="contact_role"  name="contact_role" placeholder="ingrese el cargo que tiene en la empresa " required>
                                                        <em id="contact_role-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                            <div class="col-md-4"> 
                                                <div class="form-group"> 
                                                    <label for="field-2" class="">Nro telef 1.*</label> 
                                                        <input type="text" class="form-control " id="contact_first_phone"  name="contact_first_phone" placeholder="Ingrese nro de teléfono " required>
                                                        
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
                                    <div class="col-md-12 text-right"> 
                                        <button type="submit" class="btn btn-primary btn-sm" id="btnSave"> Enviar datos</button>  
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
            <script src="{{asset('assets_admin/js/jquery.min.js')}}"></script>
            <!-- popper js -->
            <script src="{{asset('assets_web/js/popper.min.js')}}"></script>
            <!-- bootstrap js -->
            <script src="{{asset('assets_web/js/bootstrap.min.js')}}"></script>
            <!-- counterup js -->
            <script src="{{asset('assets_web/js/jquery.counterup.min.js')}}"></script>
            <!-- waypoints js -->
            <script src="{{asset('assets_web/js/waypoints.min.js')}}"></script>
            <!-- easing js -->
            <script src="{{asset('assets_web/js/jquery.magnific-popup.js')}}"></script>
            <!-- particles js -->
            <script src="{{asset('assets_web/js/owl.carousel.min.js')}}"></script>
            <!-- custom js -->
            <script src="{{asset('assets_web/js/custom.js')}}"></script>
            {{-- Toster --}}
            <script src="{{asset('assets_admin/js/toastr.min.js')}}"></script>
            <script src="{{asset('assets_web/develop_js/general_jscript.js')}}"></script>
            <script src="{{asset('assets_web/develop_js/general_jquery.js')}}"></script>
            <script src="{{asset('assets_web/develop_js/employer/register/index_jquery.js')}}"></script>
            <script src="{{asset('assets_web/develop_js/employer/register/index_jscript.js')}}"></script>
            <script type="text/javascript" src=" {{ asset('assets_admin/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
            <script>
                var csrf_token   = "{{csrf_token()}}";
                var base_url     = "{{url('')}}";
                var url_current  = "{{url()->current()}}";
            </script>
            <script>
                    function pulsar(e) 
                    { 
                        tecla = (document.all) ? e.keyCode :e.which; 
                        
                        return (tecla!=13); 
                    }
            </script>           
</body>

</html>
