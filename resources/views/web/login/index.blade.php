<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BTUNAMBA</title>
    <link rel="icon" href="{{asset('img/principal/logo.png')}}">
    <link rel="stylesheet" href="{{asset('css/style_web/principal.css')}}">
    <link rel="stylesheet" href="{{asset('assets_admin/css/simple-line-icons.css')}}" >
    <link rel="stylesheet" href="{{asset('assets_web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/css/flaticon.css')}}">
    <link href="{{asset('assets_admin/css/toastr2.min.css')}}" rel='stylesheet' type='text/css' >
    <link rel="stylesheet" href="{{asset('assets_web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/login.css')}}">
    @section('css')
    @show 
</head>

<body>
    <div class="register">
        <div id="logo" style="margin-top: 2%;margin-left: 10%;">
            <a href="index.html" ><img src="{{asset('/img/login/unamba.png')}}" alt="" title="" / style="width: 20%;"></a>
        </div>
    </div> 
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="card register">
                    <div class="card-body ">
                        <div class="">
                            <form class="frmloginEmployer" id="frmloginEmployer" action="{{route('authenticate.employer')}}" method="post">
                                <div class="row">
                                    <div class="col-md-12 text-center"><p class="h3 ">Inicio de Session</p></div>    
                                </div>    
                                
                                    @csrf
                                    <div id="content_login">
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" name ="email" aria-describedby="emailHelp" placeholder="Documento Nacional de Identidad">
                                        </div>
                                        <div class="form-group">
                                            <label for="passwordEmployer">Contraseña</label>
                                            <input type="password" class="form-control" id="passwordEmployer"  name="passwordEmployer" placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <small><a href="#" class="text-danger">¿Olvidaste tu contraseña?</a></small>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10%;">
                                        <div class="col-md-12">
                                            <button type="submit" id="btn_employer" class="btn btn-pink btn-block">Ingresar</button>
                                        </div>
                                        <div class="col-md-12 text-center mt-10">
                                            <p>¿No tienes cuenta? <a href="#" class="text-primary">Regístrate</a></p>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-md-2">

            </div>
            
        </div>
    </div>
    <script src="{{asset('assets_admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets_web/js/popper.min.js')}}"></script>
    <script src="{{asset('assets_web/js/bootstrap.min.js')}}"></script> -->
    <script src="{{asset('assets_web/js/custom.js')}}"></script>
    <script src="{{asset('assets_admin/js/toastr.min.js')}}"></script>    
    <script src="{{asset('js/login/login_jquery.js')}}"></script>
    <script src="{{asset('js/login/login_jscript.js')}}"></script>

    <script>
        var csrf_token = "{{csrf_token()}}";
        var base_url   = "{{url('')}}";
        var url_current   = "{{url()->current()}}";
    </script>
    @include('general_message')
    <!-- counterup js -->
</body>

