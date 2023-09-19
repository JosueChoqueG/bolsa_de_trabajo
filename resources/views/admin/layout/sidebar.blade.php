<div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/panel') }}">
            <i class="nav-icon icon-speedometer"></i> Inicio
            <span class="badge badge-primary">NEW</span>
          </a>
        </li>
        
        @if (permission('internalJobOffers.index'))
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/internalJobOffers') }}">
                    <i class="nav-icon  icon-book-open icons"></i> Mis ofertas
                </a>
            </li>
        @endif
        @if (permission('employerJobOffers.index'))
        <li class="nav-item">
          <a class="nav-link" href="{{url('admin/employerJobOffers') }}">
              <i class="nav-icon  icon-book-open icons"></i> Ofertas empleadores
          </a>
        </li>
        @endif
        @if (permission('candidates.index'))
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/candidates') }}">
                <i class=" nav-icon icon-user icons"></i> Estudiantes
            </a>
        </li>
        @endif
        @if (permission('employers.index'))
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/employers') }}">
                <i class=" nav-icon icon-user icons"></i> Empleadores
            </a>
        </li>
        @endif
        @if (permission('users.index'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users') }}">
              <i class="nav-icon icon-user icons"></i> Usuarios
            </a>
        </li>
        @endif
        @if (permission('roles.index'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('roles') }}">
            <i class="nav-icon icon-briefcase icons"></i> Roles
          </a>
        </li>
        @endif
        @if (permission('publications.index'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('publications') }}">
            <i class="nav-icon icon-picture icons"></i> Publicaciones
          </a>
        </li>
        @endif
        @if (permission('resources.index'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('resources') }}">
            <i class="nav-icon icon-emotsmile icons"></i> Recursos
          </a>
        </li>
        @endif
        @if (permission('reports'))
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-graph"></i> Reportes
            </a>
            <ul class="nav-dropdown-items">
                @if (permission('report.candidates'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('registeredUsers')}}">
                    <i class="nav-icon icon-people"></i> Estudiantes</a>
                </li>
                @endif
                @if (permission('report.employers'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('registeredEmployers')}}">
                    <i class="nav-icon icon-people"></i> Empleadores</a>
                </li>
                @endif
                @if (permission('report.jobOffers'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('registeredJobOffers')}}">
                    <i class="nav-icon icon-briefcase"></i> Ofertas laborales</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif
        
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/imports') }}">
              <i class="nav-icon icon-emotsmile icons"></i> Importar datos
            </a>
          </li> --}}
      
        {{--  <li class="nav-item mt-auto">
          <a class="nav-link nav-link-success" href="https://coreui.io" target="_top">
            <i class="nav-icon icon-cloud-download"></i> Download CoreUI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
            <i class="nav-icon icon-layers"></i> Try CoreUI
            <strong>PRO</strong>
          </a>
        </li>  --}}
      </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>