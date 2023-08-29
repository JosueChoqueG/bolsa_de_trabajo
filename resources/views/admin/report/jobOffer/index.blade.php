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
                <h5 class="header-title "> <i class="icon-briefcase icons fa-lg"></i> Ofertas Laborales</h5>
            </div>
            <div class="card-body">
                <form class="navbar-form " method="GET"  action="{{ url('admin/registeredJobOffers/pdfDownload')}}" id="frmBuscar" target="_blank">
                    <div class="row mt-2 ">
                        <div class="col-md-2">
                            <div class="pull-left">
                                <div class="" style="margin-top: 29%;">
                                    <a href="{{url('admin/registeredJobOffers')}}" class="btn btn-light btn-sm"><span class="fa fa-refresh"></span> Refrescar página</a>
                                </div>
                            </div> 
                        </div>
                        <div class="form-group col-md-2">
                            <label>Tipo</label>
                            <select class="form-control input-xs" id="type" name="type">
                                    <option value="">--Seleccione--</option>
                                    <option value="interna">Interna</option>
                                    <option value="externa">Externa</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Categoría</label>
                            <select class="form-control input-xs" id="category" name="category">
                                    <option value="">--Seleccione--</option>
                                    <option value="Prácticas">Prácticas</option>
                                    <option value="Empleo">Empleo</option>
                                    <option value="Becas/Pasantías">Becas/Pasantías</option>
                            </select>
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
                            <label>Estado</label>
                            <select class="form-control input-xs" id="status" name="status">
                                    <option value="">--Seleccione--</option>
                                    <option value="1">En revisión</option>
                                    <option value="2">Publicado</option>
                                    <option value="3">Cerrado</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <a  href="#" class="btn btn-primary btn-sm " id="generate_report" >Generar reporte</a>
                            @if (permission('report.jobOffersExcelDownload'))
                            <button formaction="{{ url('admin/registeredJobOffers/excelDownload') }}"  class="btn btn-success btn-sm " ><i class="fa fa-cloud-download"></i> Excel</button>
                            @endif
                            @if (permission('report.jobOffersPdfDownload'))
                            {{--<button type="submit" class="btn btn-danger btn-sm " ><i class="fa fa-cloud-download"></i> PDF</button>--}}
                            @endif
                        </div>  
                    </div>
                </form>
                <div class="table-responsive" id="content_table">
                    @include('admin.report.jobOffer.partial') 
                </div>
            </div> 
		</div>
	</div>			
</div>

@endsection

@section('scripts')
<script src="{{asset('assets_admin/develop_js/report/job_offer/index_jscript.js')}}"></script>
<script src="{{asset('assets_admin/develop_js/report/job_offer/index_jquery.js')}}"></script>
@parent
@endsection 