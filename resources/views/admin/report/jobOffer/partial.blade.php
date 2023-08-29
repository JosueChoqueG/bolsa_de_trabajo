@if($pagination == false)
<link rel="stylesheet" href="{{asset('assets_web/css/bootstrap.min.css')}}">
<style type="text/css">
    
    .cell{
      background-color:#005675;
      color: #ffffff;
      font-size: 11px;
    }
    .th{
      font-size: 11px;
    }

    tr td{
      background-color: #ffffff;
      font-size: 10;
    }
     tr > td {
      border:  1px solid #000000;
    }
</style> 
    @if($type == 'pdf')
    <table class="table">
        <thead>
            <tr>
                <th style="width:10%">
                    {{-- <img src="{{ asset('img/principal/LOGO-BOLSA.png')}}" style="height: 35px;" > --}}
                </th>
                <th  class="text-center" style="width:30%"> 

                    <h6> Lista de Ofertas laborales registradas </h6>
                </th>
                <th style="width:10%">
                    {{-- <img src="{{ asset('img/login/unamba.png')}}" style="height: 35px;" > --}}
                </th>
            </tr>
        </thead>
    </table>
    @endif
@endif
<table class="table  table-sm table-hover  table-bordered" >
    <thead >
        <tr>
            <th>Título</th>        					          				
            <th>Tipo</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th>Cod. Carreras</th>
        </tr>
    </thead>
    <tbody id="table_body" >
        
        @foreach($job_offers as $job_offer)
        <tr id="{{ $job_offer->id }}">
            <td>{{$job_offer->title}} {{$job_offer->title_complement}}</td>
            <td>{{$job_offer->type}}</td>
            <td>{{$job_offer->category}}</td>
            
            <td> 
                @if ($job_offer->status == 3)
                    <span class="badge badge-secondary">Cerrado</span>
                @elseif($job_offer->status == 2)
                <span class="badge badge-success">Publicado</span>
                @else  
                <span class="badge badge-warning">En revisión</span>  
                @endif
            </td>
            <td>
                @foreach ($job_offer->college_careers as $college_career)
                    {{$college_career->code}} <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if($pagination == true)    
    <div>
    <div class="float-left">
        Mostrando de {{ $job_offers->firstItem()}} al  {{ $job_offers->lastItem()}} de  {{ $job_offers->total()}} registros 
    </div>
    <div class="float-right">
        {{$job_offers->appends(Request::only(['type','category','college_id','status']))->render()}}   
    </div>
    </div>
@endif