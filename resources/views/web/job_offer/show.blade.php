<!--::header part start::-->
@extends('web.layout.template')
   @section('css')
       <link rel="stylesheet" href="{{asset('assets_web/develop_css/general_job_offer.css')}}">
   @parent
   @endsection
@section('content')

<section class="about_part section_padding" id="section_list">
    <div class="container">
       <div class="row">
           <div class="col-md-12">
               <nav aria-label="breadcrumb" style="width: 100%;">
                   <ol class="breadcrumb" style="background-color: #ffffff;">
                       <li class="breadcrumb-item"><a href="{{route('employers')}}">Inicio</a></li>
                       <li class="breadcrumb-item active" aria-current="page">Ofertas Laborales</li>
                       <li class="breadcrumb-item active" aria-current="page">{{$job_offer->title}}</li>
                   </ol>
               </nav>
           </div>
       </div>
       <div class="row">
           <div class="col-md-8">
               <div class="card" style="width: 100%">
                   <div class="card-body">
                       <ul class="list-group">
                           <li class="list-group-item">
                               <div class="row">
                                   <div class="col-sm-8">
                                     
                                       <h5 class="card-title card_title">{{$job_offer->title}}<small class="categoria">({{$job_offer->category}})</small></h5>
                                       @if($job_offer->type == 'externa')
                                       <h6>{{$job_offer->title_complement}}</h6>
                                       <h6 class="card-title employer_name">{{ $job_offer->employer->name}}</h6>
                                       @else
                                       <h6 class="card-title employer_name">{{$job_offer->title_complement}}</h6>
                                       @endif
                                       <h6 class="card-subtitle text-muted mt-2 mb-2"><i class="ti-location-pin"></i> <span>Ubicación</span>: <strong>{{ mb_strtoupper($job_offer->countrie->name,'utf-8')}} {{ getWorkplace($job_offer->geolocation_id) }}</strong> </h6> 
                                       <h6 class="card-subtitle text-muted mt-2"><i class="ti-calendar mr-2"></i><span>Publicado</span>: <strong>{{$job_offer->publication_date}}</strong></h6>
                                       <h6 class="card-subtitle text-muted mt-2"><i class="ti-calendar mr-2"></i><span>Finaliza</span>: <strong>{{$job_offer->finish_date}}</strong></h6>
                                   </div>
                                   <div class="col-sm-4">
                                    @if($job_offer->type == 'interna')
                                        @if($job_offer->path_logo != NULL)
                                            <img src="{{asset('img/resource/image/'.$job_offer->path_logo)}}" alt="..." class="rounded"  >
                                        @endif
                                    @else
                                        <img src="{{asset('img/employer/logo/'.$job_offer->employer->path_logo)}}" alt="..." class="rounded" >
                                    @endif
                                    </div>

                               </div>
                           </li>
                           <li class="list-group-item">
                               <p class="h5">Descripción</p>
                               <span id="description" class="text-justify"> {!!$job_offer->description!!}</span>                             
                           </li>
                       </ul>
                       @if($job_offer->type != 'interna' && $job_offer->is_postulable == '1')
                       <div class="row mt-10">
                           <div class="col-md-4"></div>
                           <div class="col-md-4 text-center">
                               <input type="hidden" value="{{$job_offer->id}}" id="job_offer_id">
                               <button type="button" class="btn btn-purple waves-effect waves-light" id="postular">Postular</button>
                           </div>
                           <div class="col-md-4"></div>
                       </div>
                       @endif
                   </div>
               </div>
           </div>
           <div class="col-md-4">
               <div class="card" >
                   <div class="card-body">
                       <h5 class="card-title card_title"><span>Resumen General</span> <a href="{{ URL::previous() }}" class="float-right" style="font-size: 15px;"> <i class="fa fa-reply"></i> Volver </a></h5>
                       
                       <ul class="list-group list-group-flush" id="ul_resumen">
                            <li >
                                
                            </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Publicado</span>: <strong> {{$job_offer->publication_date}}</strong></h6>
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Finaliza</span>: <strong> {{$job_offer->finish_date}}</strong></h6>
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Areas laborales</span>: <strong> {{$job_offer->area->name}}</strong></h6>
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Para las carreras profesionales:
                                    </h6>
                                    <ul id="colleges">
                                       @foreach ($job_offer->college_careers as $college_career)
                                       <li><h6 class="card-subtitle text-muted mt-2"><strong id="college_id"> {{$college_career->name}}</strong></h6></li>
                                       @endforeach
                                    </ul>   
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"><span>Salario</span>: @if($job_offer->type_salary == 'Fijo') <strong> S/.{{$job_offer->salary_min}}</strong> @elseif($job_offer->type_salary == 'Rango') Entre(<strong>S/.{{$job_offer->salary_min}}</strong>-<strong>S/.{{$job_offer->salary_max}}</strong>)@else<strong> {{$job_offer->type_salary}}</strong>@endif</h6>
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Jornada</span>: <strong>{{$job_offer->workday}}</strong></h6>
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Periodo de contratación</span>: @if($job_offer->type == 'interna')<strong>{{$job_offer->validity_time}}</strong> @else <strong>{{$job_offer->type_validity}}</strong> - Tiempo en meses: <strong>{{$job_offer->validity_time}}</strong>@endif</h6>
                           </li>
                           <li class="list-group-item">
                               <h6 class="card-subtitle text-muted mt-2"></i><span>Vacantes</span>: <strong>{{$job_offer->vacancies}}</strong></h6>
                           </li>
                       </ul>
                   </div>
               </div>               
           </div>
           
       </div>
    </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal_postular">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Postular</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
           <div class="row ml-10">
               <div class="col-md-12 text-center">
                   <h5 class="mt-10"><strong>Oferta de trabajo: {{$job_offer->title}}</strong></h5>
               </div>
                @php
                    $curriculum = count($candidate->curriculum_vitaes);
                @endphp

                @if($curriculum > 0)
               <div class="col-md-12">
                   <form  class="mt-5" id="frmPostulation">
                        <div class="form-group">
                            
                            <label for="exampleFormControlSelect2">Seleccione la hoja de vida que enviará</label>
                            <select class="form-control" id="curriculum_id" name="curriculum_id" required>
                                @foreach($candidate->curriculum_vitaes as $curriculum_vitae)
                                    <option value="{{$curriculum_vitae->id}}">{{$curriculum_vitae->name}}</option>
                                @endforeach
                            </select>
                            <em id="curriculum_id-error" class="error invalid-feedback messages"></em> 
                        </div>
               </div>
               @else
                <div class="col-md-12" style="background-color: #ffc446a1;">
                    <p class="h6">¡No cuenta con hojas de vida disponibles!</p>
                    <p class="h6">ingrese su hoja de vida <a href="{{route('candidate.curriculum')}}">Aquí</a></p>
                </div>
               @endif
               
           </div>
       </div>
        @if($curriculum > 0)
            <div class="modal-footer">
                <button type="submit" class="btn btn-purple waves-effect waves-light" >Postular</button>
                </form>
            </div>
        @endif
     </div>
   </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('assets_web/develop_js/job_offer/job_offer_show_jquery.js')}}"></script>
<script src="{{asset('assets_web/develop_js/job_offer/job_offer_show_jscript.js')}}"></script>
@parent
@endsection