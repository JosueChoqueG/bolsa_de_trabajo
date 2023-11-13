<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>BOLSA DE TRABAJO -UNAMBA</title>
    <!-- Icons-->
    
    <link href="{{asset('assets_admin/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('assets_admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/pace.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/toastr2.min.css')}}" rel='stylesheet' type='text/css' >
    <link rel="stylesheet" href="{{asset('assets_admin/plugins/select2/dist/css/select2.min.css')}}" type='text/css' >
    <!--link rel="stylesheet" type="text/css" href=" {{asset('assets_admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"-->
    <link rel="stylesheet" type="text/css" href=" https://bolsadetrabajo.unamba.edu.pe/assets_admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <!--link href="{{asset('assets_admin/css/custom.css')}}" rel='stylesheet' type='text/css'-->
    <link href="https://bolsadetrabajo.unamba.edu.pe/assets_admin/css/custom.css" rel='stylesheet' type='text/css' >
    <!-- Sweet Alert 2 css -->
    <link rel="stylesheet" href="{{ asset('assets_admin/plugins/sweetalert/css/sweetalert.css') }}"/>
    <link rel="stylesheet" href="{{asset('assets_admin/plugins/select2/dist/css/select2.min.css')}}" type='text/css' >
    
    {{-- <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script> --}}
    {{-- <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script> --}}
    @section('css')
    @show 
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show" >
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('img/login/unamba.png')}}" width="120" height="40" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="{{ asset('img/login/unamba.png')}}" width="30" height="30" alt="CoreUI Logo">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      {{--  <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Settings</a>
        </li>
      </ul>  --}}
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-bell"></i>
            <span class="badge badge-pill badge-danger">5</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
            <div class="dropdown-header text-center">
            <strong>Notificaciones</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="icon-user-follow "></i>Empleadores pendientes <span class="badge badge-danger">5</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="icon-bubbles icons"></i> Avisos pendientes <span class="badge badge-danger">5</span>
            </a>
            {{--  <a class="dropdown-item" href="#">
              <i class="icon-chart text-info"></i> Sales report is ready
            </a>
            <a class="dropdown-item" href="#">
              <i class="icon-basket-loaded text-primary"></i> New client
            </a>
            <a class="dropdown-item" href="#">
              <i class="icon-speedometer text-warning"></i> Server overloaded
            </a>  --}}
          </div>
        </li>
        {{--  <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-list"></i>
          </a>
        </li>
        <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-location-pin"></i>
          </a>
        </li>  --}}
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="{{ asset('img/candidate/photo/default.JPG') }}" alt="admin@bootstrapmaster.com">{{ Session::get('user_name') }}&nbsp;
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Cuenta</strong>
            </div>
            {{--  <a class="dropdown-item" href="#">
              <i class="fa fa-bell-o"></i> Updates
              <span class="badge badge-info">42</span>
            </a>  --}}
            {{--  <a class="dropdown-item" href="#">
              <i class="fa fa-envelope-o"></i> Messages
              <span class="badge badge-success">42</span>
            </a>  --}}
        
           
            <a class="dropdown-item" href="{{ url('admin/changePassword') }}">
              <i class="fa fa-key"></i> Cambiar contraseña
            </a>
           
            {{--  <a class="dropdown-item" href="#">
              <i class="fa fa-shield"></i> Lock Account</a>  --}}
            <a class="dropdown-item" href="{{ url('admin/logout') }}">
              <i class="fa fa-lock"></i> Salir</a>
          </div>
        </li>
      </ul>
      {{--  <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
      </button>  --}}
    </header>
    <div class="app-body">
      @include('admin.layout.sidebar')
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            @yield('breadcrumb')
          {{-- <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">Admin</a>
          </li>
          <li class="breadcrumb-item active">Dashboard</li>
          <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="#">
                <i class="icon-speech"></i>
              </a>
              <a class="btn" href="./">
                <i class="icon-graph"></i>  Dashboard</a>
              <a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>
            </div>
          </li> --}}
        </ol>
        <div class="container-fluid">
            @yield('content')
          <div class="animated fadeIn"></div>
        </div>
      </main>
      {{-- @include('admin.layout.aside') --}}
      
    </div>
    {{--  Formulario para eliminar   --}}
    <form id="form_delete" action="" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>

    <footer class="app-footer">
      <div>
        <a href="https://coreui.io">CoreUI</a>
        <span>&copy; 2018 creativeLabs.</span>
      </div>
      <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('assets_admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/popper.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/pace.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/coreui.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets_admin/develop_js/general_jscript.js')}}"></script>
   
    <!-- Sweet Alert js -->
    <!--script type="text/javascript" src=" {{ asset('assets_admin/plugins/sweetalert/js/sweetalert.min.js') }}"></script-->
    <script type="text/javascript" src="https://bolsadetrabajo.unamba.edu.pe/assets_admin/plugins/sweetalert/js/sweetalert.min.js"></script>
  
    @include('general_message')
    <script>
        var csrf_token = "{{csrf_token()}}";
        var base_url   = "{{url('')}}";
        var url_current   = "{{url()->current()}}";

        function deshabilitaRetroceso(){
          window.location.hash="no-back-button";
          window.location.hash="Again-No-back-button" //chrome
          window.onhashchange=function(){window.location.hash="no-back-button";}
      }
    </script>
    
 
    @section('scripts')
    @show
  </body>
</html>
