<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BTUNAMBA</title>
    <link rel="icon" href="{{asset('img/principal/logo.png')}}">
    <!-- Bootstrap CSS -->
     
    <link href="{{asset('assets_admin/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets_admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/principal.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/style.css?1')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/flaticon.css')}}">

    <link href="{{ asset('assets_admin/css/toastr2.min.css')}}"rel='stylesheet'type='text/css'> 
    <link rel="stylesheet" href="{{asset('assets_web/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets_admin/plugins/select2/dist/css/select2.min.css')}}" type='text/css' >
   
    <link rel="stylesheet" href="{{ asset('assets_admin/plugins/sweetalert/css/sweetalert.css') }}"/>
   
    
    @section('css')
    @show 
</head>

<body>
   <div class="social">
		<ul>
			<li><a href="https://www.facebook.com/bolsadetrabajounamba/" target="_blank" class="icon-facebook"> <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a></li>
            {{--<li><a href="https://api.whatsapp.com/send?phone=51950319146" target="_blank" class="icon-whatsapp"><i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a></li>--}}
            <li><a href="#" class="icon-likendin"><i class="fa fa-linkedin fa-lg" aria-hidden="true"></i></a></li>
        </ul>
    </div>

   {{-- fin barra social --}}
    <!-- about part end-->
    <header class="header_area">
    @include('web.layout.subheader') 
        <div class="main_menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="ti-menu"></i>
                            </button>
        
                            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link active" href="{{route('home')}}">Inicio</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{route('institution')}}" class="nav-link">Sobre la BTUNAMBA</a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{route('jobOffers')}}" class="nav-link">Ofertas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('events')}}" class="nav-link">Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('articles_interest')}}" class="nav-link">Artículos de Interés</a>
                                    </li>
        
                                    @if (Session::has('user_type') &&  Session::get('user_type') == 'candidate' || Session::has('user_type') && Session::get('user_type') == 'employer')
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ str_limit(Session::get('name'),10)}}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @if (Session::has('user_type') &&  Session::get('user_type') == 'candidate')
                                            <a class="dropdown-item" href="{{route('updateCandidate')}}" id>Configuración de mi cuenta</a>
                                            @else
                                            <a class="dropdown-item" href="{{route('updateEmployer')}}" id>Configuración</a>
                                            @endif
                                            <a class="dropdown-item" href="{{ url('changePassword') }}" id>Cambiar mi contraseña</a>
                                            <a class="dropdown-item" href="{{route('logoutWeb')}}" id>Cerrar Sesión</a>
                                        </div>
                                    </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="link_login">Inicio de Sesión</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')

    {{--  modal login  --}}
    @include('web.login.modal_login')    
    <!-- footer part start-->
    @include('web.layout.footer')  
    <!-- footer part end-->
    <form id="form_delete" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <!-- jquery plugins here-->
    <!-- jquery -->
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
    
    <script src="{{asset('assets_web/develop_js/home/job_offer_jquery.js')}}"></script>
    <script src="{{asset('assets_web/develop_js/home/job_offer_jscript.js')}}"></script>
    <script type="text/javascript" src=" {{ asset('assets_admin/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script>
        var csrf_token   = "{{csrf_token()}}";
        var base_url     = "{{url('')}}";
        var url_current  = "{{url()->current()}}";
        var $selected_card = null;  
    </script>
    @include('general_message')
     @section('scripts')

     @show
</body>

</html>