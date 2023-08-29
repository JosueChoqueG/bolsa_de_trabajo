 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/employer.css')}}">
    <link rel="stylesheet" href="{{asset('assets_admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
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
                                    <li class="breadcrumb-item"><a href="{{route('employers')}}">Mis Ofertas</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Crear Oferta</li>
                                </ol>
                            </nav>
                            <div class="card" style="width: 100%">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="ti-list mr-2"></i><span>Lista de Ofertas laborales</span> </h5>
                                    <div id="tabla" class="table-responsive m-t-10">
                                        <table class="  table .table-hover" id="miTabla">
                                            <thead>
                                                <tr class="cell">
                                                    <th>#</th>
                                                    <th>Titulo de la Oferta</th>
                                                    <th>Estado</th>
                                                    <th>Categoría</th>
                                                    <th>Postulantes</th>
                                                    <th>Nro. vistas</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1;
                                                @endphp
                                                @foreach($job_offers as $job_offer)
                                                    <tr id="{{$job_offer->id}}">
                                                        <td>{{ $i++}}</td>
                                                        <td><strong class="title">{{$job_offer->title}} </strong> </td>
                                                        @if($job_offer->status == '1')
                                                            <td>En revisión</td>
                                                        @elseif($job_offer->status == '2')
                                                            <td>Publicado</td>
                                                        @elseif($job_offer->status == '3')
                                                            <td>Cerrado</td>
                                                        @elseif($job_offer->status == '4')
                                                            <td>Rechazado</td>
                                                        @endif
                            
                                                        <td>{{$job_offer->category}}</td>
                                                        <td class="text-center"><a href="{{ route('employers.postulations',$job_offer->slug) }}" class="badge badge-warning" title="Ver postulantes">{{$job_offer->postulations_count}}</a></td>
                                                        <td>{{ $job_offer->view_counter }}</td>
                                                        <td>
                                                            <div class="row">
                                                              <a  href="{{route('employers.show',$job_offer->id)}}" class="btn btn-default waves-effect waves-light btn-sm m-r-5 ver" title="Ver oferta laboral" ><i class="fa  fa-eye "></i></a>
                                                            <a  href="{{route('employers.edit',$job_offer->id)}}" class="btn btn-success waves-effect waves-light btn-sm m-r-5 editar" title="Editar oferta laboral" ><i class="fa  fa-edit  "></i></a>
                                                            <a  href="#" class="btn btn-danger waves-effect waves-light btn-sm m-r-5 delete" title="Eliminar oferta laboral"><i class="fa  fa-trash  "></i></a>  
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

 <script src="{{ asset('assets_admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{ asset('assets_admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{ asset('assets_admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets_web/develop_js/employer/list_jquery.js')}}"></script>
<script src="{{asset('assets_web/develop_js/employer/list_jscript.js')}}"></script>
@parent
@endsection