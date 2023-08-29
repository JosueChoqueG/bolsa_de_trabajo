 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
        <link rel="stylesheet" href="{{asset('assets_web/develop_css/general_job_offer.css')}}">
        <link rel="stylesheet" href="{{asset('assets_admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
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
                                          Postulaciones
                                       </li>
                                   </ol>
                               </nav>
                                <div class="card" style="width: 100%">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="ti-list mr-2"></i><span>Lista de tus postulaciones</span> </h4>
                                        <div id="tabla" class="table-responsive mt-10">
                                            <table class="  table .table-hover" id="miTabla">
                                                <thead>
                                                    <tr class="cell">
                                                        <th>#</th>
                                                        <th>Oferta L.</th>
                                                        <th>Estado</th>
                                                        <th>F. publicación</th>
                                                        <th>F. postulación</th>
                                                        <th>F. Cierre</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i=1;
                                                    @endphp
                                                    @foreach($postulations as $postulation)
                                                    <tr id="{{$postulation->id}}">
                                                        <td>{{ $i++}}</td>
                                                        
                                                        <td class="title"> 
                                                            <a href="{{route('jobOffers.show',$postulation->job_offer->id)}}" class="title"> {{strtoupper($postulation->job_offer->title)}}</a>
                                                        </td>
                                                        <td>
                                                            @if($postulation->status == 'Enviado')
                                                            <span class="badge badge-info">{{$postulation->status}}</span>
                                                            @elseif($postulation->status == 'Visto')
                                                            <span class="badge badge-success">{{$postulation->status}}</span>
                                                            @else()
                                                            <span class="badge badge-warning">{{$postulation->status}}</span>
                                                            @endif
                                                        </td>
                                                        @php
                                                            $dt     = new DateTime($postulation->created_at);
                                                            $date   = $dt->format('d/m/Y');
                                                            $dt1     = new DateTime($postulation->job_offer->publication_date);
                                                            $date1   = $dt1->format('d/m/Y');
                                                            $dt2     = new DateTime($postulation->job_offer->finish_date);
                                                            $date2   = $dt2->format('d/m/Y');
                                                        @endphp
                                                        <td>
                                                            <h6 class="card-subtitle text-muted mt-2">
                                                                <i class="ti-calendar mr-2"></i>
                                                                <strong>{{$date1}}</strong> 
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="card-subtitle text-muted mt-2">
                                                                <i class="ti-calendar mr-2"></i> 
                                                                <strong>{{$date}}</strong>
                                                            </h6>
                                                        </td>
                                                        
                                                        <td>
                                                            <h6 class="card-subtitle text-muted mt-2">
                                                                <i class="ti-calendar mr-2"></i> 
                                                                <strong>{{$date2}}</strong>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger btn-sm delete"><i class="fa  fa-trash  "></i> <span class="ml-2">Eliminar</span> </a>
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
                       <div class="col-md-1">
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
    <script src="{{asset('assets_web/develop_js/candidate/postulation_jquery.js')}}"></script>
    <script src="{{asset('assets_web/develop_js/candidate/postulation_jscript.js')}}"></script>
@parent
@endsection