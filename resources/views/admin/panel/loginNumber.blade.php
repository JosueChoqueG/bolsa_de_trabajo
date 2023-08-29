@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Reporte de Estudiantes/Egresados</li>
         
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i>Inicios de Sesión (Lista de de estudiantes y egresados)</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
                        <div class="float-right">
                             <button type="button" class="btn btn-default btn-sm btn-list" id="btn_volver" > <i class="fa fa-reply"></i>   Volver</button> 
                        </div>
                    </div>
                </div>
                {{-- <form class="navbar-form " method="GET" action="{{ url('admin/registeredUsers/pdfDownload')}}" id="frmBuscar" target="_blank">
                    <div class="row mt-2 ">
                        <div class="col-md-2">
                            <div class="pull-left">
                                <div class="" style="margin-top: 29%;">
                                    <a href="{{url('admin/registeredUsers')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                                </div>
                            </div> 
                        </div>
                    
                        <div class="form-group col-md-4">
                            <label>Carrera profesional</label>
                            <select class="form-control input-xs" id="college_id" name="college_id">
                                    <option value="">--Seleccione--</option>
                                    @foreach ($colleges as $college)
                                        <option value="{{old('college_id', $college->id )}}"  > {{$college->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Sexo</label>
                            <select class="form-control input-xs" id="sexo" name="sexo">
                                    <option value="">--Seleccione--</option>
                                    <option value="F">Femeníno</option>
                                    <option value="M">Masculíno</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4"style="margin-top: 3.2%;">
                            <a  class="btn btn-primary btn-sm " id="generate_report">Generar reporte</a>
                            @if (permission('report.candidatesExcelDownload'))
                            <button formaction="{{ url('admin/registeredUsers/excelDownload') }}" class="btn btn-success btn-sm " ><i class="fa fa-cloud-download"></i> Excel</button>
                            @endif
                            @if (permission('report.candidatesPdfDownload'))
                            <button type="submit" class="btn btn-danger btn-sm " ><i class="fa fa-cloud-download"></i> PDF</button>
                            @endif

                        </div> 
                            
                    </div>
                </form> --}}
                <div class="table-responsive" id="content_table">
                    <table class="table  table-sm table-hover  table-bordered table-border" id="miTabla">
                        <thead >
                            <tr class="cell">
                                <th>N°</th>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>          					          				
                                <th>Sexo</th>
                                <th>Programa</th>
                                <th>Escuela</th>
                                <th>Visitas</th>
                            </tr>
                        </thead>
                        <tbody id="list_candidates" >
                            
                            @foreach($candidates as $key => $candidate)
                            <tr id="{{ $candidate->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{$candidate->document}}</td>
                                <td>{{$candidate->name}}</td>
                                <td>{{$candidate->first_lastname}} {{$candidate->second_lastname}}</td>
                                <td>{{$candidate->gender}}</td>
                                <td>
                                    @foreach ($candidate->college_careers as $college_career)
                                            - {{ $college_career->code}} <br>
                                    @endforeach
                                </td>
                                <td>
                                @foreach ($candidate->college_careers as $college_career)
                                    {{$college_career->name}} <br>
                                @endforeach
                                </td>
                                <td>{{$candidate->sessions_count}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
		</div>
	</div>			
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets_admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets_admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets_admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/panel/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/panel/index_jquery.js?1')}}"></script>
@parent
@endsection 