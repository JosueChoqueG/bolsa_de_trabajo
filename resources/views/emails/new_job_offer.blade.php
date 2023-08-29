@component('mail::message')

Hola **{{ $candidate->name}}**, se ha publicado una nueva oferta de empleo para ti:   
#### {{$job_offer->title  }} {{ $job_offer->title_complement }}
-----------------------------------------------------
{{-- @if($job_offer->type == 'interna')
    @if($job_offer->path_logo != NULL)
        ![Logo]({{asset('img/employer/logo/'.$job_offer->path_logo)}})
        <img src="{{asset('img/employer/logo/'.$job_offer->path_logo)}}" alt="">
        <img src="{{ $message->embed($job_offer->path_logo) }}">
    @endif
@else
![Logo]({{asset('img/employer/logo/'.$job_offer->employer->path_logo)}})
<img src="{{ asset('img/employer/logo/'.$job_offer->employer->path_logo)"alt=""> }}
<img src="{{ $message->embed($job_offer->employer->path_logo) }}">
@endif --}}

{!!  $job_offer->introduction !!}       
**Ubicación:** {{ mb_strtoupper($job_offer->countrie->name,'utf-8')}} {{ getWorkplace($job_offer->geolocation_id) }}  
**Vacantes:** {{ $job_offer->vacancies }}  
**Salario:** @if($job_offer->type_salary == 'Fijo')  S/.{{$job_offer->salary_min}} @elseif($job_offer->type_salary == 'Rango') Entre(S/.{{$job_offer->salary_min}} - S/.{{$job_offer->salary_max}})@else {{$job_offer->type_salary}}@endif  
**Fecha límite de postulación:** {{ $job_offer->finish_date}}

<small>Mira el detalle de esta oferta y otras haciendo click en el boton "Ver más ofertas" </small>

@component('mail::button', [ 'url' => $url ])
    Ver más ofertas
@endcomponent

<br>
   <small> OFICINA DE SEGUIMIENTO AL GRADUADO </small>
{{-- {{ config('app.name') }} --}}
@endcomponent
