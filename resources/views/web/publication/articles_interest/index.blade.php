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
                        <li class="breadcrumb-item active" aria-current="page">Artículos de Interés</li>
                    </ol>
                </nav>
           </div>
       </div>
          
       <div class="row ">
            <div class="col-md-3">
                    <div class="card mt-10">
                        <form action="{{ url('articles_interest') }}" method="GET">
                            <div class="card-header">
                                <i class="fa fa-search"></i> BUSQUEDA
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="{{ url('articles_interest') }}">Limpiar todos los filtros</a>
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
                <div class="row mb-10">
                    @foreach ($articles_interest as $article_interest)
                        @php
                            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                            $d = $article_interest->created_at;
                            $day    = strftime("%d", strtotime($d)); 
                            $fecha  = strftime("%B  %Y", strtotime($d)); 
                        @endphp
                        
                            <div class="card mb-3 mr-2 card_list card_article" style="max-width: 17rem;" id="{{$article_interest->slug}}">
                                <div class="content_image">
                                   <img src="{{asset('/img/resource/image/'.$article_interest->path_image)}}" class="card-img-top_article" style="border-top-left-radius:initial !important;border-top-right-radius:initial !important;">
                                    <time class="card__date">
                                        <div>
                                            <span class="card__date-number startDate">{{$day}}</span>
                                        </div>
                                        <div class="Y">{{$fecha}}</div>
                                    </time>
                                </div>
                                
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$article_interest->title}}</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-justify">
                                            {!!strip_tags(str_limit($article_interest->description, 200),'br,div')!!}
                                            <span id="detalles"> Ver más</span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                       
                    @endforeach
                </div>
                <div class="row text-center mt-3">
                    <div class="col-md-5"></div>
                    <div class="col-md-4">{{$articles_interest->appends(Request::only(['title']))->render()}}   </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div> 
   </div>
</section>

@endsection
@section('scripts')

<script src="{{asset('assets_web/develop_js/articles/index_jquery.js')}}"></script>
@parent
@endsection