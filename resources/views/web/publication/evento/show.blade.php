<!--::header part start::-->
@extends('web.layout.template')
   @section('css')
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
        <link rel="stylesheet" href="{{asset('assets_web/develop_css/event.css')}}">
   @parent
   @endsection
@section('content')

<section class="about_part section_padding" id="section_list">
    <div class="container">
       <div class="row">
           <div class="col-md-12">
               <nav aria-label="breadcrumb" style="width: 100%;">
                   <ol class="breadcrumb" style="background-color: #ffffff;">
                       <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                       <li class="breadcrumb-item "><a href="{{route('events')}}">Eventos</a></li>
                       <li class="breadcrumb-item active" aria-current="page">{{$event->title}}</li>
                   </ol>
               </nav>
           </div>
       </div>
       <div class="row">
           <div class="col-md-9">
               <div class="card" style="width: 100%">
                   <div class="card-body">
                        <div class="row  mb-10" >
                            <div class="col-md-12 text-center">
                                <h3 class="card-title title_show">{{$event->title}}</h3>  
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card-group">
                                    <div class="card ticket" style="box-shadow: none!important;">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-md-2 mt-2">
                                                    <i class="icon-calendar fa-2x icon_show"></i>
                                                </div>
                                                @php
                                                  setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                                                    $d = $event->event_date;
                                                    $fecha = strftime("%d de %B del %Y", strtotime($d)); 
                                                @endphp
                                                <div class="col-md-10">
                                                    <p class="card-text">Fecha</p>
                                                    <h6 class="card-title">{{$fecha}}</h6>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card ticket" style="box-shadow: none!important;">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-md-2 mt-2">
                                                    <i class="ti-time fa-2x icon_show"></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="card-text">Horario</p>
                                                    <h6 class="card-title">{{date("g:i a",strtotime($event->start_time))}} - {{date("g:i a",strtotime($event->end_time))}}</h6>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card ticket" style="box-shadow: none!important;">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-md-2 mt-2">
                                                    <i class="ti-wallet fa-2x icon_show"></i>
                                                </div>
                                                
                                                <div class="col-md-10">
                                                    <p class="card-text"> Costo</p>
                                                    <h6 class="card-title"> @if($event->cost < 0) Gratuito @else {{$event->cost}} Soles @endif</h6>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        <div class="row mb-10" style="margin-bottom: 3%;">
                            <div class="col-md-1">

                            </div>
                            <div class="col-sm-10">
                                <img src="{{asset('/img/resource/image/'.$event->path_image)}}" alt="..." class="rounded"  >
                            </div>

                        </div>
                        <div class="row mt-10">
                            <div class="col-md-12 text-justify">
                                <span id="description"> {!!$event->description!!}</span> 
                            </div>
                        </div>
                        @if(count($images)>0)
                        <hr>
                        <div class="row mt-10">
                            <div class="col-md-12 text-center"><h3 id="title_gallery"> <i class="ti-image"></i> Galería de Fotos</h3></div>                      
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($images as $key=>$image)
                                        <div @if($key == 0) class="carousel-item  active" @else  class="carousel-item" @endif>
                                            <img src="{{asset('/img/resource/image/'.$image->path)}}" class="d-block w-100" alt="...">
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div> 
                            </div>
                        </div>
                        @endif
                        <hr>
                        <p class="mt-10">Compartir</p>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a class="fa fa-facebook icon_social" id="facebook"></a>
                                <a class="fa fa-twitter icon_social ml-2" id="twitter"></a>
                                {{-- <a class="fa fa-google icon_social ml-2" id="google"></a> --}}
                                <a class="fa fa-whatsapp icon_social ml-2" id="whatsapp"></a>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
           <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item li_volver "><a href="{{ URL::previous() }}" class="float-right " style="font-size: 15px;"> <i class="fa fa-reply"></i> Volver </a></li>
                            <li class="list-group-item text-center"><h5 class="card-title">EVENTOS RELACIONADOS</h5></li>
                        </ul>
                    </div>
                </div>
                @foreach ($related_events as $event)
                @php
                    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                    $d = $event->event_date;
                    $day    = strftime("%d", strtotime($d)); 
                    $fecha  = strftime("%B  %Y", strtotime($d)); 
                @endphp
                <a href="{{route('events.show',$event->id)}}" class="card_list">
                    <div class="card mb-3">
                        <img src="{{asset('/img/resource/image/'.$event->path_image)}}" class="card-img-top" style="border-top-left-radius:initial !important;border-top-right-radius:initial !important;">
                        <time class="card__date">
                            <div>
                                <span class="card__date-number startDate">{{$day}}</span>
                                {{-- <span class="card__date-number endDate">09</span> --}}
                            </div>
                            <div class="Y">{{$fecha}}</div>
                        </time>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{$event->title}}</h5>
                            </div>
                    </div>
                </a>
                @endforeach
           </div>
       </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('assets_web/develop_js/publication/red_social.js')}}"></script>
@parent
@endsection