 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/job_offer.css')}}">
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
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb" style="width: 100%;">
                                    <ol class="breadcrumb" style="background-color: #ffffff;">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('employers')}}">Mis Ofertas</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Ver({{$job_offer->title}})</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                <div class="blog_right_sidebar">
                                    <aside class="single_sidebar_widget post_category_widget">
                                        <h4 class="widget_title">Datos generales del empleo</h4>
                                        <ul class="list cat-list">
                                            
                                            <li class="general">
                                                <p><strong>Puesto/Título de la Oferta: </strong>{{$job_offer->title}}</p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Complemento del titulo: </strong>{{$job_offer->title_complement}}</p>
                                            </li >
                                            <li class="general">
                                                <p><strong>Introducción: </strong>{{$job_offer->introduction}}</p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Categoría: </strong>{{$job_offer->category}}</p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Área laboral: </strong>{{$area->name}}</p>
                                            </li >
                                            <li class="general">
                                                <p><strong>Escuelas académicas que aplican: </strong>
                                                <ul id="colleges">
                                                    @foreach ($job_offer->college_careers as $college_career)
                                                    <li><h6 class="card-subtitle text-muted mt-2"><strong id="college_id"> {{$college_career->name}}</strong></h6></li>
                                                    @endforeach
                                                 </ul>  
                                            </li>
                                            <li class="general">
                                                <p><strong>Pais: </strong>{{$countrie->name}} </p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Ubicación del empleo: </strong><strong>{{ mb_strtoupper($job_offer->countrie->name,'utf-8')}} {{ getWorkplace($job_offer->geolocation_id) }}</strong> 
                                            </li>
                                            <li class="general">
                                                <p><strong>Jornada laboral: </strong>{{$job_offer->workday}}</p>
                                            </li>
                                            <li class="general" >
                                                <p><strong>Salario: </strong>  @if($job_offer->type_salary == 'Fijo') <strong> S/.{{$job_offer->salary_min}}</strong> @elseif($job_offer->type_salary == 'Rango') Entre(<strong>S/.{{$job_offer->salary_min}}</strong>-<strong>S/.{{$job_offer->salary_max}}</strong>)@else<strong> {{$job_offer->type_salary}}</strong>@endif</p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Vacantes: </strong>{{$job_offer->vacancies}}</p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Vigencia del empleo: </strong>{{$job_offer->type_validity}} @if($job_offer->type_validity != 'Por definir')- <b>Meses:</b> {{$job_offer->validity_time}} @endif</p>
                                            </li>
                                            <li class="general">
                                                <p><strong>Fecha de cierre: </strong>{{$job_offer->finish_date}}</p>
                                            </li>
                                            
                                            
                                        </ul>
                                    </aside>
                                </div>
            
                            </div>
                            <div class="col-md-6">
                                
                                <div class="blog_right_sidebar">
                                    <aside class="single_sidebar_widget post_category_widget">
                                        <h4 class="widget_title">Descripción de la oferta laboral</h4>
                                            <ul class="list cat-list">
                                                <li>
                                                        {!!$job_offer->description!!} 
                                                </li>
                                            </ul>
                                    </aside>
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
<script src="{{asset('assets_web/develop_js/employer/list_jquery.js')}}"></script>
<script src="{{asset('assets_web/develop_js/employer/list_jscript.js')}}"></script>
@parent
@endsection