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
                                        Mi Hoja de Vida
                                    </li>
                                </ol>
                            </nav>
                                
                            <div class="card mb-3" style="width: 100%">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="ti-file mr-2"></i><span>Mi hoja de Vida</span> </h5>

                                        <form  id="frmCurriculum" action="{{route('curriculum.create')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-10">
                                                {{-- <div class="custom-file"> --}}
                                                    {{-- <input type="file" class="custom-file-input" id="archive" name="archive" required>
                                                    <label class="custom-file-label" for="customFileLangHTML" data-browse="Elegir">Seleccionar Archivo</label> --}}
                                                <div class="form-group col-md-6">
                                                    <label for="">Nombre del documento:</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Documento" required>
                                                    <em class="text-danger">{{ @$errors->first('name') }}</em>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Link de la nube donde se encuentra su hoja de vida:</label>
                                                    <input type="text" class="form-control" id="archive" name="archive" placeholder="link" required>
                                                    <em class="text-danger">{{ @$errors->first('archive') }}</em>
                                                </div>
                                            </div>
                                            <div class="col-md-12  mt-10 text-center">
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-add"></i> <span>Añadir hoja de vida</span></button>
                                            </div>
                                        </form>

                                </div>
                            </div>
                            <div class="card" style="width: 100%">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="ti-list mr-2"></i><span>Lista de Hojas de vida</span> </h5>
                                    
                                    <div id="tabla" class="table-responsive mt-10">
                                        <table class="  table .table-hover" id="miTabla">
                                            <thead>
                                                <tr class="cell">
                                                    <th>#</th>
                                                    <th>CV a enviar</th>
                                                    <th>Nombre Doc.</th>
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1;
                                                @endphp
                                                @foreach($candidate->curriculum_vitaes as $curriculum_vitae)
                                                <tr id="{{$curriculum_vitae->id}}">
                                                    <td>{{ $i++}}</td>
                                                    
                                                    @if($curriculum_vitae->status == 1)
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input status" type="radio" name="status" id="{{'status'.$i}}" value="option1" checked>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input status" type="radio" name="status" id="{{'status'.$i}}" value="option1" >
                                                            </div>
                                                        </td>
                                                    @endif
                                                    {{-- <td><a href="{{asset('/resource/curriculum/'.$curriculum_vitae->path)}}" target="_blank"><strong class="name">{{$curriculum_vitae->name}}</strong></a></td>--}}
                                                    <td><a href="{{$curriculum_vitae->path}}" target="_blank"><strong class="name">{{$curriculum_vitae->name}}</strong></a></td>
                                                    @php
                                                        $dt     = new DateTime($curriculum_vitae->created_at);
                                                        $date   = $dt->format('d/m/Y');
                                                        
                                                    @endphp
                                                    <td>{{$date}}</td>
                                                    <td>
                                                        <a type="button" href="#" class="btn btn-danger waves-effect waves-light btn-sm mr-5 delete"><i class="fa  fa-trash  "></i> <span class="ml-2">Eliminar</span> </a>
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
    <script src="{{asset('assets_web/develop_js/candidate/curriculum_jquery.js')}}"></script>
    <script src="{{asset('assets_web/develop_js/candidate/curriculum_jscript.js')}}"></script>
@parent
@endsection