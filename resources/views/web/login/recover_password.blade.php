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
                    <div class="offset-md-3  col-md-6">
                        <form role="form"  method="POST" action="{{ url('recoverPassword/'.$user_type) }}"  id="frmRecover"> 
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12 text-center">
                                        <a href="{{route('home')}}">
                                            <img src="{{ asset('img/login/unamba.png')}}" style="height: 67px;" id="logo_home">
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class=" col-md-12 text-center">
                                            <h3>Restablece tu contraseña</h3>
                                        </div>
                                    </div>
                                    <hr>
                                        <div class="row">
                                            <div class="col-md-12"> 
                                                <div class="form-group"> 
                                                    <label for="field-2" class=""> Correo electrónico</label> 
                                                        <input type="email" class="form-control " id="email"  value="" name="email" placeholder="Ingresa el correo electrónico de tu cuenta" required>
                                                        <em id="email-error" class="error invalid-feedback"></em>  
                                                </div> 
                                            </div>
                                        </div>
                                       @if (Session::has('status'))
                                        <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show" role="alert">
                                                {{ Session::get('message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          
                                       @endif
                                    {{-- </fieldset> --}}
                                </div>
                                <div class="card-footer"> 
                                    <button type="submit" class="btn btn-primary btn-block" id="btnSave"> Enviar enlace de restablecimiento de contraseña</button>  
                                </div> 
                                
                            </div>
                        </form>
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
            {{-- <script src="{{asset('assets_web/develop_js/employer/register/index_jquery.js')}}"></script>
            <script src="{{asset('assets_web/develop_js/employer/register/index_jscript.js')}}"></script> --}}
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
