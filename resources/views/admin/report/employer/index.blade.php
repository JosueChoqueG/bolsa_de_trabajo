@extends('admin.layout.template')
  @section('breadcrumb')
   
    <li class="breadcrumb-item">
        <a href="{{url('panel')}}">Inicio</a>
    </li>
    <li class="breadcrumb-item active">Empresas y/o Entidades registradas</li>
         
@endsection
@section('content')
 <div class="row" id="content_index">
	<div class="col-md-12 ">
		<div class="card">
            <div class="card-header">
                <h5 class="header-title "> <i class="icon-people icons fa-lg"></i> Empresas y/o Entidades registradas</h5>
            </div>
            <div class="card-body">
                <form class="navbar-form " method="GET"  action="{{ url('admin/registeredEmployers/pdfDownload')}}" id="frmBuscar" target="_blank" >
                    <div class="row mt-2 ">
                        <div class="col-md-2">
                            <div class="pull-left">
                                <div class="" style="margin-top: 29%;">
                                    <a href="{{url('admin/registeredEmployers')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                                </div>
                            </div> 
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sector</label>
                            <select class="form-control input-xs" id="sector_id" name="sector_id">
                                <option value="">--Seleccione--</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{old('sector_id', $sector->id )}}"  > {{$sector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Estado</label>
                            <select class="form-control input-xs" id="status" name="status">
                                    <option value="">--Seleccione--</option>
                                    <option value="En revisión">En revisión</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5"style="margin-top: 3.2%;">
                            <a type="submit" class="btn btn-primary btn-sm " id="generate_report" >Generar reporte</a>
                            @if (permission('report.employersExcelDownload'))
                            <button formaction="{{ url('admin/registeredEmployers/excelDownload') }}"  class="btn btn-success btn-sm " ><i class="fa fa-cloud-download"></i> Excel</button>
                            @endif
                            @if (permission('report.employersPdfDownload'))
                            {{--<button href="#"  class="btn btn-danger btn-sm "><i class="fa fa-cloud-download"></i> PDF</button>--}}
                            @endif
                        </div>  
                    </div>
                </form>
                <div class="table-responsive" id="content_table">
                    @include('admin.report.employer.partial') 
                </div>
            </div> 
		</div>
	</div>			
</div>

@endsection

@section('scripts')
<script src="{{asset('assets_admin/develop_js/report/employer/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/report/employer/index_jquery.js')}}"></script>
@parent
@endsection 