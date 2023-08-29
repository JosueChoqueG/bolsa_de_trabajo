<!--::header part start::-->
@extends('web.layout.template')
   @section('css')
   <link rel="stylesheet" href="{{asset('assets_web/develop_css/employer.css')}}">
   @parent
   @endsection
@section('content')


<section class="about_part section_padding" id="curriculum">
   <div class="container-fluid">
       <div class="row">
           <div class="col-md-2" id="left_content">
               @include('web.layout.submenu_employer')
           </div>
           <div class="col-md-10" id="rigth_content">
               <div class="row">
                   <div class="col-md-11" id="sub_right">
                       <div class="row">
                           <nav aria-label="breadcrumb" style="width: 100%;">
                               <ol class="breadcrumb" style="background-color: #ffffff;">
                                   <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                   <li class="breadcrumb-item"><a href="{{route('employers')}}">Mis Ofertas</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Postulaciones</li>
                               </ol>
                           </nav>

                            <input type="hidden" id="job_offer_id" value="{{ @$postulations[0]->job_offer_id }}">
                            <div class="card mb-2 border-primary" style="width: 100%;">
                                <div class="card-body text-center">
                                    <h3>POSTULACIONES PARA</h3>
                                    <h3>{{ strtoupper($job_offer->title) }}</h3>
                                </div>
                            </div>
                            @foreach ($postulations as $postulation)
                            <div class="card border-info mb-3 card_job_offer" style="width: 100%;">
                            
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-3" >
                
                                        @if( is_null($postulation->candidate->path_photo))
                                            <img src="{{ asset('img/candidate/photo/default.JPG')}}" alt="..." class="img-fluid"   >
                                        @else
                                            <img src="{{ asset('img/candidate/photo/'.$postulation->candidate->path_photo.'')}}" alt="..." class="img-fluid"  >
                                        @endif
                                            <div class="form-check">
                                                <input type="checkbox" id="candidate_{{ $postulation->candidate->id }}" name="status" value="Finalista" class="finalist" {{ ($postulation->status == 'Finalista' )?'checked':'' }}>
                                                <label for="candidate_{{ $postulation->candidate->id }}"> <b> Candidato Finalista</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <p class="h5">{{  strtoupper($postulation->candidate->name.' '.$postulation->candidate->first_lastname.' '.$postulation->candidate->second_lastname)}}</p>
                                            
                                            <h6 class="card-subtitle text-muted mt-2 mb-2"> <strong>DNI/CE</strong>: {{ $postulation->candidate->document }} </h6> 
                                            <h6 class="card-subtitle text-muted mt-2 mb-2"> <strong>Genero</strong>: {{ $postulation->candidate->gender}}</h6> 
                                            <h6 class="card-subtitle text-muted mt-2 mb-2"> <strong>Carreras</strong>:</h6> 
                                            <ol>
                                                @foreach ($postulation->candidate->college_careers as $item)
                                                <li>{{ $item->name }}</li>
                                                @endforeach
                                            </ol>
                                            <h6 class="card-subtitle text-muted mt-2 mb-2"> <strong>Teléfono</strong>: {{ $postulation->candidate->first_phone }} / {{ $postulation->candidate->second_phone }} </h6>
                                            <h6 class="card-subtitle text-muted mt-2 mb-2"> <strong>Correo electrónico</strong>: {{ $postulation->candidate->email }}  </h6>
                                            <h6 class="card-subtitle text-muted mt-2 mb-2"> <strong>Curriculum vitae</strong>: 
                                            @foreach ($postulation->candidate->curriculum_vitaes as $item)
                                                @if($item->id == $postulation->curriculum_id)
                                                <a href="{{ $item->path }}" class="badge badge-primary link_cv"  value="candidate_{{ $postulation->candidate->id }}" target="_blank"> click aqui para ver mi  CV</a>
                                                @endif
                                            @endforeach
                                            </h6> 
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                        </div>
                   </div>
           </div>
       </div>
   </div>
</section>

@endsection
@section('scripts')
<script src="{{asset('assets_web/develop_js/job_offer/postulation_jquery.js')}}"></script>
<script src="{{asset('assets_web/develop_js/job_offer/postulation_jscript.js')}}"></script>
@parent
@endsection