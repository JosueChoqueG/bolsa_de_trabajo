<!--::header part start::-->
@extends('web.layout.template')
    @section('css')
        <link rel="stylesheet" href="{{asset('assets_web/develop_css/event.css')}}">
        @parent
    @endsection
    @section('submenu_employer')
        @include('web.layout.submenu_employer')
    @endsection
@section('content')

<section class="about_part section_padding" id="section_list">
    <div class="container">
       <div class="row">
           <div class="col-md-12">
               <nav aria-label="breadcrumb" style="width: 100%;">
                    <ol class="breadcrumb" style="background-color: #ffffff;">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Eventos</li>
                    </ol>
                </nav>
           </div>
       </div>
          
       <div class="row ">
           <div class="col-md-3">
                <div class="card mt-10" >
                    <form action="{{ url('events') }}" method="GET">
                        <div class="card-header">
                            <i class="fa fa-search"></i> BUSQUEDA
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ url('events') }}">Limpiar todos los filtros</a>
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
                    </form>
                </div>
           </div>
           <div class="col-md-9">
               <div class="row">
                @foreach ($events as $event)
                @php
                    $dt1     = new DateTime($event->event_date);
                    $date1   = $dt1->format('d/m/Y');
                @endphp
                    <div class="card mb-3 mr-2 card_list  card_event" style="max-width: 17rem;" id="{{$event->slug}}">
                        
                            <img src="{{asset('/img/resource/image/'.$event->path_image)}}" class="card-img-top" style="border-top-left-radius:initial !important;border-top-right-radius:initial !important;">
                            <div class="card-body text-center">
                               <h5 class="card-title">{{$event->title}}</h5>
                                <div class="row">
                                    <div class="col-md-12 text-justify">
                                        {!!strip_tags(str_limit($event->description, 200),'br,div')!!}
                                        <span id="detalles"> Ver más</span>
                                    </div> 
                                </div>
                            </div>
                        
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 text-center left-header">
                                    <small><i class="ti-calendar mr-1"></i></small>
                                    <small><strong> {{$date1}}</strong></small>
                                </div>
                                <div class="col-md-6 text-center right-header" >
                                    <small><i class="ti-time mr-1"></i></small>
                                    <small><strong>{{$event->start_time}} - {{$event->end_time}}</strong></small>  

                                </div>
                            </div>
                        </div>
                    </div>
               
                @endforeach
               </div>
                
                <div class="row text-center">
                    <div class="col-md-5"></div>
                    <div class="col-md-4">{{$events->appends(Request::only(['title']))->render()}}   </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>      
   </div>
</section>

@endsection
@section('scripts')

<script src="{{asset('assets_web/develop_js/event/index_jquery.js')}}"></script>
@parent
@endsection