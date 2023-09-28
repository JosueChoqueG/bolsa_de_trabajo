@extends('admin.layout.template')
@section('css')
    <link rel="stylesheet" href="{{asset('assets_admin/css/panel.css?1')}}">
@parent
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">Home</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="brand-card">
            <div class="brand-card-body">
                <div>
                    <button type="button" class="btn btn-primary" onclick="window.open('http://localhost/carousel/View/editar.php', '_blank');">IR A SLIDE</button>
					<h5> Administrar Slide en portada </h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="brand-card">
            <div class="brand-card-header bg-facebook">
                <i class="icon-eye"></i>
                <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="social-box-chart-1" height="96" width="248" class="chartjs-render-monitor" style="display: block; width: 248px; height: 96px;"></canvas>
                <div id="social-box-chart-1-tooltip" class="chartjs-tooltip bottom" style="opacity: 0; left: 207px; top: 72px;"><div class="tooltip-header"><div class="tooltip-header-item">June</div></div><div class="tooltip-body"><div class="tooltip-body-item"><span class="tooltip-body-item-color" style="background-color: rgb(255, 255, 255);"></span><span class="tooltip-body-item-label">My First dataset</span><span class="tooltip-body-item-value">55</span></div></div></div></div>
            </div>
            <div class="brand-card-body">
                <div>
                <div class="text-value">{{getVisitsCounter() }}</div>
                <div class="text-uppercase text-muted small">Número de Visitas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card  text-white bg-danger">
            <div class="card-body pb-0">
                <div class="text-value">{{$count_job_offer}}</div>
                <div> <a href="{{url('admin/registeredJobOffers')}}">Ofertas laborales</a> </div>
            </div>
            <div class="brand-card-body">
                <div>
                    <div class="text-value">{{$count_job_offer_publish}}</div>
                    <div class="text-uppercase text-muted small"><a href="{{url('admin/registeredJobOffers?type=&category=&college_id=&status=2')}}">Publicadas</a> </div>
                </div>
                <div>
                    <div class="text-value">{{$count_job_offer_revision}}</div>
                    <div class="text-uppercase text-muted small"> <a href="{{url('admin/registeredJobOffers?type=&category=&college_id=&status=1')}}">En revisión</a> </div>
                </div>
                <div>
                    <div class="text-value">{{$count_job_offer_closed}}</div>
                    <div class="text-uppercase text-muted small"><a href="{{url('admin/registeredJobOffers?type=&category=&college_id=&status=3')}}">Cerradas</a> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card  text-white bg-info">
            <div class="card-body pb-0">
                <div class="text-value">{{$count_employer}}</div>
                <div> <a href="{{url('admin/registeredJobOffers')}}">Empleadores</a> </div>
            </div>
            <div class="brand-card-body">
                <div>
                    <div class="text-value">{{$count_employer_active}}</div>
                    <div class="text-uppercase text-muted small"><a href="{{url('admin/registeredEmployers?sector_id=&status=Activo')}}">Activos</a> </div>
                </div>
                <div>
                    <div class="text-value">{{$count_employer_revision}}</div>
                    <div class="text-uppercase text-muted small"> <a href="{{url('admin/registeredEmployers?sector_id=&status=En+revisi%C3%B3n')}}">En revisión</a> </div>
                </div>
                <div>
                    <div class="text-value">{{$count_employer_inactive}}</div>
                    <div class="text-uppercase text-muted small"><a href="{{url('admin/registeredEmployers?sector_id=&status=Inactivo')}}">Inactivos</a> </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-sm-6 col-lg-3">
        <div class="brand-card">
            <div class="brand-card-header bg-google-plus">
                <i class="icon-login"></i>
                <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="social-box-chart-1" height="96" width="248" class="chartjs-render-monitor" style="display: block; width: 248px; height: 96px;"></canvas>
                <div id="social-box-chart-1-tooltip" class="chartjs-tooltip bottom" style="opacity: 0; left: 207px; top: 72px;"><div class="tooltip-header"><div class="tooltip-header-item">June</div></div><div class="tooltip-body"><div class="tooltip-body-item"><span class="tooltip-body-item-color" style="background-color: rgb(255, 255, 255);"></span><span class="tooltip-body-item-label">My First dataset</span><span class="tooltip-body-item-value">55</span></div></div></div></div>
            </div>
            <div class="brand-card-body">
                <div>
                    <div class="text-value">{{getStartSessionCounter()}}</div>
                    <div class="text-uppercase text-muted small"><a href="{{url('admin/loginNumber')}}" style="color: #73818f">Inicios de Sesión</a></div>
                </div>
            </div>
        </div>
    </div>  
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                    <h5> Estudiantes y egresados registrados </h5>
                    <table class="table table-responsive-sm table-hover table-outline mb-0 mt-4">
                        <thead class="thead-light">
                            <tr>
                                <th>Carrera profesional</th>
                                <th>logo</th>
                                <th class="text-center">Mujeres</th>
                                <th class="text-center">Varones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colleges as $college)
                                <tr>
                                    <td>
                                        <div>{{$college->name}}</div>
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('img/home/'.$college->code.'.png')}}" style="height: 35px;" >
                                    </td>
                                    <td class="text-center">
                                        <strong><a href="{{url('/admin/registeredUsers?college_id='.$college->id.'&sexo=F')}}" class="a_redirect">{{$college->count_femenino}}</a></strong>
                                    </td>
                                    <td class="text-center">
                                        <strong><a href="{{url('/admin/registeredUsers?college_id='.$college->id.'&sexo=M')}}" class="a_redirect">{{$college->count_masculino}}</a></strong>
                                    </td>
                                </tr>
                            @endforeach
                            
                            
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
                    
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script type="text/javascript">
    var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ofertas Laborales registradas por Escuela'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
        text: 'Número total de ofertas laborales'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
        borderWidth: 0,
        dataLabels: {
            enabled: true,
            format: '{point.y:.0f}'
        }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: Se encuentra en <b>{point.y:.0f}</b> ofertas registradas <br/>'
    },

    series: [
        {
        name: "Escuela",
        colorByPoint: true,
        data: [
            @foreach ($colleges as $college)
                {
                name:'{{$college->name}}',
                y: {{$college->count_jobOffer}},
                drilldown: '{{$college->name}}'
                },
            @endforeach
            ]
        }
    ]
    
    }
    );
</script>
@parent
@endsection 
