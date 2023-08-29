 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('css/style_web/employer.css')}}">
    @parent
    @endsection
 @section('content')

 <section class="about_part section_padding" id="section_list">
     <div class="container">
        <div class="row">
            <div class="col-sm-4">
                    <div class="card" style="width: 18rem;float: right;">
                        <div class="card-header">
                            <i class="fa fa-search"></i> BUSQUEDA
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" placeholder="Ingrse título" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="button" id="button-addon2">
                                            <i class="fa fa-search ">    </i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                                                     
                        </ul>
                    </div>
                <div class="card mt-10" style="width: 18rem;float: right;">
                    <div class="card-header">
                        <i class="fa fa-filter"></i><strong> </strong> FILTROS
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5>Estado de oferta</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="">Todos</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">En revisión</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">Publicado</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">Rechazado</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">Cerrrado</a>
                                </li>
                            </ul>
                        </li> 
                        <li class="list-group-item">
                            <h5>Tipo de Oferta</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="">Laboral</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">Prácticas</a>
                                </li>
                            </ul>
                        </li>                           
                    </ul>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card border">
                    <div class="job-badge">
                        <label class="label bg-primary">New</label>
                    </div>
                    <div class="card-body">
                        <p class="h5">Bootstrap heading(PRÁCTICAS)</p>
                        <h6 class="card-subtitle mb-2 text-muted">18 de Marzo del 2019</h6>
                        <div class="row mt-10">
                            <div class="col-md-3">Postulantes:<a href="#" class="badge badge-warning">10</a></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="dropdown_action" style="float:right;">
                                    <button class="btn_action btn btn-ligh"><i class="fa fa-ellipsis-v fa-lg" style="float: right;"></i></button>
                                    <div class="dropdown_action-content">
                                        <div class="list-group">
                                            <button type="button" class="list-group-item list-group-item-action">Ver</button>
                                            <button type="button" class="list-group-item list-group-item-action">Editar</button>
                                            <button type="button" class="list-group-item list-group-item-action">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
            
                    </div>
                </div>
                <div class="card">
                    <div class="job-badge">
                        <label class="label bg-primary">New</label>
                    </div>
                    <div class="card-body">
                        <p class="h5">Bootstrap heading</p>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus alias ab adipisci, debitis eum id cumque dolorum, fugiat autem animi inventore. Odio, provident. Molestias inventore eaque necessitatibus sapiente nostrum rerum.</p>
                
                        <div class="row mt-10">
                            <div class="col-md-3">Postulantes:<a href="#" class="badge badge-warning">10</a></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="dropdown_action" style="float:right;">
                                    <button class="btn_action btn btn-ligh"><i class="fa fa-ellipsis-v fa-lg" style="float: right;"></i></button>
                                    <div class="dropdown_action-content">
                                        <div class="list-group">
                                            <button type="button" class="list-group-item list-group-item-action">Ver</button>
                                            <button type="button" class="list-group-item list-group-item-action">Editar</button>
                                            <button type="button" class="list-group-item list-group-item-action">Eliminar</button>
                                        </div>
                                    </div>
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

<script src="{{asset('js/js_web/employer/list_jquery.js')}}"></script>
<script src="{{asset('js/js_web/employer/list_jscript.js')}}"></script>
@parent
@endsection