 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('css/style_web/employer.css')}}">
    <link rel="stylesheet" href="{{asset('assets_admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    @parent
    @endsection
 @section('content')

 <section class="about_part section_padding" id="section_list">
     <div class="container">
        <div class="row">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    
                    <ul class="list-group">
                        <li class="list-group-item">
                        <h5 class="card-title">{{$job_offer->title}}<small class="categoria">({{$job_offer->category}})</small></h5>
                            <h6 class="card-title">{{$job_offer->title_complement}}</h6>
                            <div class="row">
                                <div class="col-md-4">
                                <p id="geolocation_id">{{$department->name}}-{{$province->name}}-{{$district->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p id="publication_date">{{$job_offer->publication_date}}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <p><span>jornada de trabajo: </span> <strong id="workday">{{$job_offer->workday}}</strong></p>
                            <p><span>Cantidad de vacantes: </span> <strong id="vacancies">{{$job_offer->vacancies}}</strong></p>
                            <p class="h5">Descripción</p>
                            <span id="description"> {!!$job_offer->description!!}</span>
                            <p class="h5">Requisitos</p>
                            <span id="requeriments">{!!$job_offer->requirements!!}</span>
                            <p><span>para las escuelas académicas: </span> @foreach ($job_offer->college_careers as $college_career)
                                <strong id="college_id">{{$college_career->name}}</strong>, 
                            @endforeach</p>

                            <p class="h5">Funciones</p>
                            <span id="tasks">
                                {!!$job_offer->tasks!!}
                            </span>

                            <p class="h5">Beneficios</p>
                            <p><span>Salario: </span> <strong id="salary">{{$job_offer->salary}}</strong></p>
                            <span id="is_offered">
                                {!!$job_offer->is_offered!!}
                            </span>
                            <p><span>Fecha de contratacion: </span> <strong id="finish_date">{{$job_offer->finish_date}}</strong></p>
                            <span id="additional_information">
                                {!!$job_offer->additional_information!!}
                            </span>
                            


                        </li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
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