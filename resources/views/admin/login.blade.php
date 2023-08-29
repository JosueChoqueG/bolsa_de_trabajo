
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
<meta name="author" content="Łukasz Holeczek">
<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
<title>Panel de administrador</title>

    <link href="{{asset('assets_admin/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('assets_admin/css/style.css?nocache=')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/pace.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_admin/css/toastr.min.css')}}" rel='stylesheet' type='text/css' >
<script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o), m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-49801694-4', 'auto', {'allowLinker': true});
    ga('require', 'linker');
    ga('linker:autoLink', ['gumroad.com','coreui.io']);
    ga('send', 'pageview');

    ga('create', 'UA-118965717-1', 'auto', {'name': 'sharedTracker', 'allowLinker': true});
    ga('sharedTracker.require', 'linker');
    ga('sharedTracker.linker:autoLink', ['gumroad.com','coreui.io']);
    ga('sharedTracker.send', 'pageview');
  </script>
</head>
<body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <form action="{{ url('/admin/authentication') }}" method="POST">
                   {{csrf_field()}}
                  <h1>Iniciar sesión</h1>
                  <p class="text-muted">Ingrese sus datos de usuario</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-user"></i>
                      </span>
                    </div>
                    <input class="form-control" name="email" type="text" placeholder="Email">
                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
                      </span>
                    </div>
                    <input class="form-control" type="password" name="password" placeholder="Contraseña">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button  type="submit" class="btn btn-primary " type="button"> Ingresar <i class="icon-login fa-lg"></i></button>
                    </div>
                    <div class="col-6 text-right">
                      {{--<button type="button" class="btn btn-link px-0" type="button">Olvido su contraseña?</button>--}}
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h1>UNAMBA</h1>
                  <span>BOLSA DE TRABAJO</span>
                  <!--button class="btn btn-primary active mt-3" type="button">Register Now!</button-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script src="{{asset('assets_admin/js/jquery.min.js')}}"></script>
<script src="{{asset('assets_admin/js/popper.min.js')}}"></script>
<script src="{{asset('assets_admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets_admin/js/pace.min.js')}}"></script>
<script src="{{asset('assets_admin/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets_admin/js/coreui.min.js')}}"></script>
<script src="{{asset('assets_admin/js/toastr.min.js')}}"></script>

<script>
    $('#ui-view').ajaxLoad();
    $(document).ajaxComplete(function() {
      Pace.restart()
    });
  </script>
  @include('general_message')
</body>
</html>