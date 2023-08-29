<!--::header part start::-->
@extends('web.layout.template')
   @section('css')
        <link rel="stylesheet" href="{{asset('assets_web/develop_css/event.css')}}">
        <link rel="stylesheet" href="{{asset('assets_web/develop_css/home.css')}}">
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
                            <li class="breadcrumb-item active" aria-current="page">Sobre la BTUNAMBA</li>
                        </ol>
                    </nav>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 text-center"><h2 class="card-title bolsa" style="font-size: 40px !important;" >sobre la Bolsa de trabajo UNAMBA</h2></div>
        </div>
        <div class="row mb-3">
            <p class="card-text text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim atque iste aut dolorem nulla ea facilis? Perferendis possimus inventore velit error earum itaque eius animi, quod dicta at sequi corrupti. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto distinctio nemo harum? Possimus natus est quos sapiente obcaecati impedit reprehenderit dolor autem neque molestiae omnis, ipsam debitis. Impedit, nulla nam?</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blog-card">
                    <div class="meta">
                        <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-2.jpg)"></div>
                    </div>
                    <div class="description">
                        <h1>Misión</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blog-card alt">
                    <div class="meta">
                        <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-2.jpg)"></div>
                    </div>
                    <div class="description">
                        <h1>Visión</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
