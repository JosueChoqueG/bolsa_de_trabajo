<!--::header part start::-->
@extends('web.layout.template')
   @section('css')
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
                       <li class="breadcrumb-item "><a href="{{route('articles_interest')}}">Artículos de Interés</a></li>
                       <li class="breadcrumb-item active" aria-current="page">{{$article_interest->title}}</li>
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
                                <h3 class="card-title title_show" style="color: #007D53;">{{$article_interest->title}}</h3>  
                            </div>
                        </div>
                        <div class="row mb-3">
                          
                                
                        </div>
                        <div class="row mb-10" style="margin-bottom: 3%;">
                            <div class="col-md-1">

                            </div>
                            <div class="col-sm-10">
                                <img src="{{asset('/img/resource/image/'.$article_interest->path_image)}}" alt="..." class="rounded"  >
                            </div>

                        </div>
                        <div class="row mt-10">
                            <div class="col-md-12 text-justify">
                                <span id="description"> {!!$article_interest->description!!}</span> 
                            </div>
                        </div>
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
                            <li class="list-group-item li_volver"><a href="{{ URL::previous() }}" class="float-right " style="font-size: 15px;"> <i class="fa fa-reply"></i> Volver </a></li>
                            <li class="list-group-item text-center"><h5 class="card-title">ARTÍCULOS RELACIONADOS</h5></li>
                        </ul>
                    </div>
                </div>
                @foreach ($articles_interest as $article_interest)
                @php
                    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                    $d = $article_interest->created_at;
                    $day    = strftime("%d", strtotime($d)); 
                    $fecha  = strftime("%B  %Y", strtotime($d)); 
                @endphp
                <a href="{{route('articles_interest.show',$article_interest->id)}}" class="card_list">
                    <div class="card mb-3">
                        <img src="{{asset('/img/resource/image/'.$article_interest->path_image)}}" class="card-img-top" style="border-top-left-radius:initial !important;border-top-right-radius:initial !important;">
                        <time class="card__date">
                            <div>
                                <span class="card__date-number startDate">{{$day}}</span>
                                {{-- <span class="card__date-number endDate">09</span> --}}
                            </div>
                            <div class="Y">{{$fecha}}</div>
                        </time>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{$article_interest->title}}</h5>
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