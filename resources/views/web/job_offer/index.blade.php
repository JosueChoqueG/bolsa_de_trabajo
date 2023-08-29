<!--::header part start::-->
@extends('web.layout.template')
   @section('css')
   <link rel="stylesheet" href="{{asset('assets_web/develop_css/general_job_offer.css')}}">
   @parent
   @endsection


{{-- @section('submenu_employer')
    @include('web.layout.submenu_employer')
@endsection --}}
@section('content')

<section class="about_part section_padding" id="section_list">
    <div class="container">
       <div class="row">
           <div class="col-md-12">
               <nav aria-label="breadcrumb" style="width: 100%;">
                   <ol class="breadcrumb" style="background-color: #ffffff;">
                       <li class="breadcrumb-item"><a href="{{route('employers')}}">Inicio</a></li>
                       <li class="breadcrumb-item active" aria-current="page">Ofertas Laborales</li>
                   </ol>
               </nav>
           </div>
       </div>
          
       <div class="row">
        <div class="col-sm-2 col-md-3">
            <form action="{{ url('jobOffers') }}" method="GET">
            {{-- <div class="card" >
                <div class="card-header">
                    <i class="fa fa-search"></i>FILTROS SELECCIONADOS
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5>Lugar de trabajo</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="">Abancay</a>
                            </li>
                        </ul>
                    </li> 
                </ul>
            </div> --}}
            <div class="card mt-10" >
                <div class="card-header">
                    <i class="fa fa-search"></i> BUSQUEDA
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ url('jobOffers') }}">Limpiar todos los filtros</a>
                    </li>
                    <li class="list-group-item">
                        <div class="input-group input-group-sm mb-3">
                            <input type="search" class="form-control" name="title" value="{{ @$title }}" placeholder="Ingrese título" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" id="button-addon2">
                                    <i class="fa fa-search ">    </i>
                                </button>
                            </div>
                        </div>
                    </li>
                   
                                                
                </ul>
            </div>
            <div class="card mt-10" >
                <div class="card-header">
                    <i class="fa fa-list-ol"></i> ORDENAR POR
                </div>
                <ul class="list-group list-group-flush">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-check" >
                                <input class="form-check-input filter" type="radio"  {{ (@$order== 'salary_min')?'checked':'' }} value="salary_min" class="college_id" id="salary_min" name="order">
                                <label for="salary_min" class="form-check-label">
                                    Salario
                                </label>
                            
                            </div>
                        </li> 
                        <li class="list-group-item">
                            <div class="form-check" >
                                <input class="form-check-input filter" type="radio"  {{ (@$order== 'publication_date')?'checked':'' }} value="publication_date" class="college_id" id="publication_date" name="order" >
                                <label for="publication_date" class="form-check-label">
                                        Fecha de publicación
                                </label>
                                
                            </div>
                        </li>
                    </ul>                       
                </ul>
            </div>
            <div class="card mt-10" >
                <div class="card-header">
                    <i class="fa fa-filter"></i><strong> </strong> FILTROS
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5><b>  Carrera profesional</b></h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($colleges as $key => $college)
                            <li class="">   
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="checkbox" value="{{ $college->id }}" {{ (in_array($college->id, empty($college_id)?[]:$college_id))?'checked':'' }}  id="college_{{$college->id}}" name="college_id[]">
                                    <label for="college_{{$college->id}}" class="form-check-label">
                                            {{$college->name}}<mark>({{$college->job_offers_count}})</mark>
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <h5> <b>Paises</b> </h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($countries  as $countrie)
                                <li class="list-group-item">
                                        <input class="form-check-input filter" type="checkbox" value="{{ $countrie->id }}" {{ (in_array($countrie->id, empty($countrie_id)?[]:$countrie_id))?'checked':'' }}  id="countrie_{{$countrie->id}}" name="countrie_id[]">
                                        <label for="countrie_{{$countrie->id}}" class="form-check-label">
                                                {{ $countrie->name }}<mark>({{$countrie->job_offers_count}})</mark>
                                        </label>
                                </li>
                            @endforeach
                        </ul>
                    </li> 
                    <li class="list-group-item">
                        <h5> <b>Lugar de trabajo </b></h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($locations  as $location)
                                <li class="list-group-item">
                                        <input class="form-check-input filter" type="checkbox" value="{{ $location->id }}" {{ (in_array($location->id, empty($location_id)?[]:$location_id))?'checked':'' }}  id="location_{{$location->id}}" name="location_id[]">
                                        <label for="location_{{$location->id}}" class="form-check-label">
                                                {{ getWorkplace($location->id) }}<mark>({{$location->job_offers_count}})</mark>
                                        </label>
                                </li>
                            @endforeach
                        </ul>
                    </li> 
                    <li class="list-group-item">
                        <h5><b>Tipo de Oferta</b></h5>
                        <ul class="list-group list-group-flush">
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"  {{ (@$category== 'Empleo')?'checked':'' }} value="Empleo"  id="Empleo" name="category">
                                    <label for="Empleo" class="form-check-label">
                                        Empleo
                                    </label>
                                </div>
                            </li>
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"  {{ (@$category== 'Practicas')?'checked':'' }} value="Practicas"  id="Practicas" name="category">
                                    <label for="Practicas" class="form-check-label">
                                        Prácticas
                                    </label>
                                </div>
                            </li>
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"  {{ (@$category== '')?'checked':'' }} value=""  id="null_category" name="category">
                                    <label for="null_category" class="form-check-label">
                                        Todo
                                    </label>
                                </div>
                            </li>
                            
                        </ul>
                    </li>   
                 
                    <li class="list-group-item">
                        <h5><b> Jornada Laboral</b></h5>
                        <ul class="list-group list-group-flush">
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"  {{ (@$workday== 'Tiempo completo')?'checked':'' }} value="Tiempo completo"  id="Tiempo_completo" name="workday">
                                    <label for="Tiempo_completo" class="form-check-label">
                                            Tiempo completo
                                    </label>
                                </div>
                            </li>
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"  {{ (@$workday== 'Medio tiempo')?'checked':'' }} value="Medio tiempo"  id="Medio_tiempo" name="workday">
                                    <label for="Medio_tiempo" class="form-check-label">
                                            Medio tiempo
                                    </label>
                                </div>
                              
                            </li>
                           
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"   {{ (@$workday== 'Por horas')?'checked':'' }} value="Por horas"  id="Por_horas" name="workday">
                                    <label for="Por_horas" class="form-check-label">
                                            Por horas
                                    </label>
                                </div>
                            </li>
                            <li class="">
                                <div class="form-check" >
                                    <input class="form-check-input filter" type="radio"   {{ (@$workday== '')?'checked':'' }} value=""  id="null_jornada" name="workday">
                                    <label for="null_jornada" class="form-check-label">
                                        Todas
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </li>
                   
                   
                    <li class="list-group-item">
                        <h5><b>Área laboral</b></h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($areas  as $area)
                                <li class="">   
                                    <div class="form-check" >
                                        <input class="form-check-input filter" type="checkbox" value="{{ $area->id }}" {{ (in_array($area->id, empty($area_id)?[]:$area_id))?'checked':'' }}  id="area_{{$area->id}}" name="area_id[]">
                                        <label for="area_{{$area->id}}" class="form-check-label">
                                                {{$area->name}}<mark>({{$area->job_offers_count}})</mark>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                                            
                </ul>
            </div>
            </form>
        </div>

           <div class="col-sm-9">
               @foreach ($job_offers as $job_offer)
                   
                   @if($job_offer->type == 'interna')
                       <div class="card border-info mb-3 card_job_offer" style="border-color: #7C2C49 !important;" id="{{$job_offer->slug}}">
                           <div class="type"  style="background: #7C2C49 !important;">
                               <span> Publicado por: Bolsa de trabajo</span>
                           </div>
                   @else  
                   <div class="card border-info mb-3 card_job_offer" style="border-color: #00B08C !important;" id="{{$job_offer->slug}}">
                           <div class="type"  style="background: #00B08C !important;">
                               <span> Publicado por: {{$job_offer->employer->name}}</span>
                           </div>
                   @endif
                       @if($job_offer->category == 'Prácticas')
                           <div class="job-badge" style="border-top-color: #4F3C1E !important;">
                               <label class="label bg-primary" style="background: #C3552F !important;">Practicas</label>
                           </div>
                       @elseif($job_offer->category == 'Empleo')
                           <div class="job-badge" style="border-top-color: #4F3C1E !important;">
                               <label class="label bg-primary" style="background: #897456 !important;">Empleo</label>
                           </div>
                        @else
                        <div class="job-badge" style="border-top-color: #4F3C1E !important;">
                            <label class="label bg-primary" style="background: #402E32 !important;">Becas/Pasantías</label>
                        </div>
                       @endif
                       <div class="card-body mt-3">
                           <div class="row">
                               <div class="col-md-9">  
                                    <p class="h5" > <a href="#" class="title">{{mb_strtoupper($job_offer->title, 'UTF-8')}}</a>  @if($job_offer->status == 2)<small class="text-success"> <strong>(Convocatoria vigente)</strong></small> @else<small class="text-danger"> <strong>(Convocatoria concluida)</strong></small>@endif</p>
                                    @if($job_offer->type != 'interna')
                                        <p class="h6 empresa" >{{mb_strtoupper($job_offer->employer->name, 'UTF-8')}}</p>
                                    @endif
                                    @php
                                       $pais = mb_strtoupper($job_offer->countrie->name,'utf-8');
                                    @endphp
                        
                                    <h6 class="card-subtitle text-muted mt-2 mb-2"><i class="ti-location-pin"></i> <span>Ubicación</span>: <strong>{{ $pais}} {{ getWorkplace($job_offer->geolocation_id) }}</strong> </h6> 
                                    <h6 class="card-subtitle text-muted mt-2 mb-2"><i class="ti-user"></i> <span>Vacantes</span>: <strong>{{$job_offer->vacancies}}</strong> </h6> 
                                    @php
                                            $salary_min = $job_offer->salary_min;
                                            $salary_max = $job_offer->salary_max;
                                            $salary_min = number_format($salary_min,2);
                                            $salary_max = number_format($salary_max,2);
                                    @endphp
                                    <h6 class="card-subtitle text-muted mt-2 mb-2"><i class="ti-list"></i> <span>Salario</span>: @if($job_offer->type_salary == 'Fijo') <strong> S/ {{$salary_min}}</strong> @elseif($job_offer->type_salary == 'Rango') Entre( <strong>S/.{{$salary_min}}</strong> - <strong>S/.{{$salary_max}}</strong> )@else<strong> {{$job_offer->type_salary}}</strong>@endif</p> 
                                    <p style="text-align: justify;">{{ $job_offer->introduction }} <span id="detalles"> ...Ver más detalles de la oferta laboral</span></p> 
                                    @php
                                            $dt1            = new DateTime($job_offer->publication_date);
                                            $publication    = $dt1->format('d/m/Y');
                                            $dt2            = new DateTime($job_offer->finish_date);
                                            $finish         = $dt2->format('d/m/Y');
                                        @endphp
                                    <h6 class="card-subtitle text-muted mt-2"><i class="ti-calendar mr-2"></i><span>Publicado</span>: <strong>{{$publication}}</strong> <i class="ti-calendar mr-2 ml-2"></i><span> Finaliza</span>: <strong>{{$finish}}</strong></h6>
                               </div>
                               <div class="col-md-3 mt-5" >

                                @if($job_offer->type == 'interna' && ! is_null($job_offer->path_logo))
                                    <img src="{{ asset('img/resource/image/'.$job_offer->path_logo)}}" alt="..." class="rounded"  >
                                @elseif(! empty($job_offer->employer->path_logo))
                                    <img src="{{ asset('img/employer/logo/'.$job_offer->employer->path_logo)}}" alt="..." class="rounded"  >
                                @endif
                                </div>
                           </div>
                       </div>
                   </div>
               @endforeach
               <div class="row text-center">
                   <div class="col-md-5"></div>
                   <div class="col-md-4">{{$job_offers->appends(Request::only(['title','college_id','category','workday','area','order','location_id','countrie_id']))->render()}}   </div>
                   <div class="col-md-2"></div>
               </div>
               
           </div>
       </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('assets_web/develop_js/job_offer/job_offer_jquery.js?v1')}}"></script>
<script src="{{asset('assets_web/develop_js/job_offer/job_offer_jscript.js?v1')}}"></script>
@parent
@endsection