 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/event.css')}}">
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/home.css')}}">
    @parent
    @endsection
 @section('content')
 <?php 
    $conn = mysqli_connect("localhost", "root", "", "bolsadet_job_boart"); 
    
?>
<section class=" TamanoSlider">
    <div class="row">
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" >
                
                <div class="carousel-inner" id="flex-container" >
                    <?php
                    $sql = "SELECT * FROM carousel ORDER BY id ASC";
                    $result = $conn->query($sql);
                    $active = true;

                    // Generar los elementos del carrusel
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Obtén la ruta de la imagen desde la base de datos
                            $imagePath = $row['img'];
                            // Convierte el contenido de la imagen a base64
                            $imageBase64 = base64_encode($imagePath);
                            // Establece la clase "active" en el primer elemento
                            $activeClass = $active ? 'active' : '';
                    
                            echo '<div class="carousel-item flex-item ' . $activeClass . '" id="flex">
                                    <img src="data:image/jpeg;base64, '.$imageBase64.'"  alt="...">
                                    <img src="data:image/jpeg;base64, '.$imageBase64.'"  alt="...">
                                </div>';
                    
                            $active = false;
                        }
                    }

                    // Cerrar la conexión a la base de datos
                    $conn->close();
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="gallery_part section_padding " style="padding-top: 0px;padding-bottom: 12px;">

    <div class="row">
        <div class="card-group">
            <div class="card" >
                <div class="card-body text-center">
                    <i class="ti-user fa-3x" style="color: #2C55A2;"></i>
                    <h3><span class="count">{{$count_candidate}}</span>+</h3>
                    <h5 class="card-title">Usuarios Registrados</h5>
                </div>
            </div>
            <div class="card" >
                <div class="card-body text-center">
                    <i class="ti-user fa-3x" style="color: #CF1A71;"></i>
                    <h3><span class="count">{{$count_employer}}</span>+</h3>
                    <h5 class="card-title">Empleadores Registrados</h5>
                </div>
            </div>
            <div class="card" >
                <div class="card-body text-center">
                    <i class="ti-announcement fa-3x" style="color:#FAB600;"></i>
                    <h3><span class="count">{{$count_job_offer}}</span>+</h3>
                    <h5 class="card-title">Ofertas Laborales</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <i class="ti-eye fa-3x" style="color:#3ca6aa;"></i>
                    <h3><span class="count">{{ getVisitsCounter() }}</span>+</h3>
                    <h5 class="card-title">Visitas </h5>
                </div>
            </div>
        </div>
    </div>

</section>
<section class="gallery_part section_padding" style="">
    <div class="container">
        <div class="row mb-5 mt-3">
            <div class="col-md-12 text-center"><h2 class="card-title title_joboffer" style="font-size: 30px !important;" > <i class="ti-briefcase mr-4 "></i> Ofertas Laborales</h2></div>
        </div>
       
        <div class="row text-center">
            @foreach ($job_offers as $job_offer)
            @php
                setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                $d1      = $job_offer->publication_date;
                $fecha1  = strftime(" %d de %B del %Y", strtotime($d1)); 
            @endphp
                <div class="card ml-3 mb-3 card_job_offer" style="width: 16rem;" id="{{$job_offer->slug}}">
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

                    <div class=" row content_image " style="height: 25%; padding-top: 8%;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            @if($job_offer->type == 'interna' && ! is_null($job_offer->path_logo))
                                <img src="{{ asset('img/resource/image/'.$job_offer->path_logo)}}" alt="Responsive image" class="card-img-top" >
                            @elseif(! empty($job_offer->employer->path_logo))
                                <img src="{{ asset('img/employer/logo/'.$job_offer->employer->path_logo)}}" alt="Responsive image" class="card-img-top" >
                            @endif
                        </div>
                    </div>
                    <div class="card-body text-justify ">
                        <p class="h6"> <strong>{{mb_strtoupper($job_offer->title, 'UTF-8')}}</strong></p>
                        <hr>
                        <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($product ?? '',500,' ...') }} <span id="detalles">Ver más detalles</span></p> 
                    </div>
                    <div class="card-footer text-muted">
                            Publicado
                        <br>
                            <strong><small>
                        {{$fecha1}}
                        </small></strong>
                    </div>
                </div>
           
            @endforeach
        </div>
        <div class="row">
            <div class="card-body text-center">
                <a href="{{route('jobOffers')}}" class="card-link" style="color:#474c50;">Ver todas las ofertas laborales >>></a>
            </div>
        </div>
        
    </div>
</section>
<section class="gallery_part section_padding" style="">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center"><h2 class="card-title title_joboffer" style="font-size: 30px !important;" > <i class="ti-ticket mr-4 "></i> Eventos</h2></div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="bd-example">
                    <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($events as $key=>$event)
                                <div class="carousel-item @if($key == 0)active @endif">
                                        <ul class="list-group">
                                            <li class="list-group-item disabled" style="height:210px;padding:0px;">
                                                <img class="card-img-top" src="{{asset('/img/resource/image/'.$event->path_image)}}" class="img-fluid"  >
                                            </li>
                                            <li class="list-group-item" style="border-top-width: 0px;">
                                                <h4 class="card-title">{{$event->title}}</h4>
                                                <p class="card-text">{!!strip_tags(str_limit($event->description, 200),'br,div')!!}</p>
                                            </li>
                                        </ul>    
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
               
            </div>
            <div class="col-md-7">
                <div class="list-group">
                    @foreach ($events as $event)
                    @php
                        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                        $d1      = $event->event_date;
                        $day     = strftime(" %d", strtotime($d1)); 
                        $fecha1  = strftime(" %B ", strtotime($d1)); 
                    @endphp
                        <a href="{{route('events.show',$event->slug)}}" class="list-group-item list-group-item-action li_event">
                            <div class="row row_event">
                                <div class="col-md-2 text-center fecha_event">
                                    <h3 style="color: white;">{{$day}}</h3>
                                    <h5 style="color: white;">{{$fecha1}}</h5>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{$event->title}}</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-body text-center">
                <a href="{{route('events')}}" class="card-link" style="color:#474c50;">Ver todos los eventos >>></a>
            </div>
        </div>
    </div>
</section> 
<section class="gallery_part section_padding" style="">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center"><h2 class="card-title title_joboffer" style="font-size: 30px !important;" > <i class="ti-ticket mr-4 "></i> Artículos de Interés</h2></div>
        </div>
            <div class="row">
           <!--Carousel Wrapper-->
            <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
                <div class="controls-top text-center mb-3">
                    <a class="btn-floating btn btn-light" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left fa-lg"></i></a>
                    <a class="btn-floating btn btn-light" href="#multi-item-example" data-slide="next"><i
                        class="fa fa-chevron-right fa-lg"></i></a>
                </div>
                <!--/.Controls-->
            
                <!--Indicators-->
                <ol class="carousel-indicators">
                    <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                    <li data-target="#multi-item-example" data-slide-to="1"></li>
                    <li data-target="#multi-item-example" data-slide-to="2"></li>
                </ol>
                <!--/.Indicators-->
            
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
            
                <!--First slide-->
                @foreach ($articles_interest as $key=>$article_interest)
                @php
                    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                    $d = $article_interest->created_at;
                    $day    = strftime("%d", strtotime($d)); 
                    $fecha  = strftime("%B  %Y", strtotime($d)); 
                @endphp
                    <div class="carousel-item @if($key == 0)active @endif">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('articles_interest.show',$article_interest->slug)}}">
                                    <div class="card mb-3" >
                                        <div class="row no-gutters">
                                            <div class="col-md-4 ">
                                                <div class="content_image" style="border-radius: initial;">
                                                    <img class="left" src="{{asset('/img/resource/image/'.$article_interest->path_image)}}"></div>
                                                <time class="card__date" style="line-height: 30px;">
                                                    <div>
                                                        <span class="card__date-number startDate date_article">{{$day}}</span>
                                                    </div>
                                                    <div class="Y year_article">{{$fecha}}</div>
                                                </time>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h1 class="h1_article">{{$article_interest->title}}</h1>
                                                    <div class="separator"></div>
                                                    <p class="p_article">{!!strip_tags(str_limit($article_interest->description, 500),'br,div')!!}</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                                
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
      <!--/.Carousel Wrapper-->
       </div>

        <div class="row">
            <div class="card-body text-center">
                <a href="{{route('articles_interest')}}" class="card-link" style="color:#474c50;">Ver todos los artículos >>></a>
            </div>
        </div>
    </div>
</section>  


 {{--  modal publish  --}}
 {{-- @include('web.layout.modal_publish') --}} 
@endsection
@section('scripts')
    <script>
        $( document ).ready(function() {
            $('#modal_publish').modal('toggle')
        });
    </script>
@parent
@endsection
