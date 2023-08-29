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
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Reporte de Estudiantes/Egresados</h5>
            </div>
            <div class="card-body">
                <form class="navbar-form " method="GET" action="{{ url('admin/registeredUsers/pdfDownload')}}" id="frmBuscar" target="_blank">
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
                            {{--<button type="submit" class="btn btn-danger btn-sm " ><i class="fa fa-cloud-download"></i> PDF</button>--}}
                            @endif

                        </div> 
                            
                    </div>
                </form>
                <div class="table-responsive" id="content_table">
                    @include('admin.report.candidate.partial') 
                </div>
            </div> 
		</div>
	</div>			
</div>

@endsection

@section('scripts')
<script src="{{asset('assets_admin/develop_js/report/candidate/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/report/candidate/index_jquery.js')}}"></script>
@parent
@endsection 