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
                    <img src="{{ asset('img/principal/LOGO-BOLSA.png')}}" style="height: 35px;" >
                </th>
                <th  class="text-center" style="width:30%"> 

                    <h4> Estudiantes y Egresados Registrados
                        
                    </h4>
                    @if($college_career != null && $sexo != null )
                    <small class="text-muted">(Estudiantes y egresados registrados de la carrera profesional de {{$college_career->name}} del sexo: {{$sexo}})</small>
                    @endif
                    @if($college_career == null && $sexo != null )
                    <small class="text-muted">(Estudiantes y egresados registrados del sexo:{{$sexo}})</small>
                    @endif
                    @if($college_career != null && $sexo == null )
                    <small class="text-muted">(Estudiantes y egresados registrados de la carrera profesional de {{$college_career->name}})</small>
                    @endif
                </th>
                <th style="width:10%">
                    <img src="{{ asset('img/login/unamba.png')}}" style="height: 35px;" >
                </th>
            </tr>
        </thead>
    </table>
    @endif
@endif
<table class="table  table-sm table-hover  table-bordered table-border" >
    <thead >
        <tr class="cell">
            <th>N°</th>
            <th>DNI</th>
            <th>Nombres</th>
            <th>Apellidos</th>          					          				
            <th>Sexo</th>
            <th>Programa</th>
            <th>Escuela</th>
        </tr>
    </thead>
    <tbody id="list_candidates" >
        
        @foreach($candidates as $key => $candidate)
        <tr id="{{ $candidate->id }}">
            <td>{{$key+1}}</td>
            <td>{{$candidate->document}}</td>
            <td>{{$candidate->name}}</td>
            <td>{{$candidate->first_lastname}} {{$candidate->second_lastname}}</td>
            <td>{{$candidate->gender}}</td>
            <td>
                @foreach ($candidate->college_careers as $college_career)
                        - {{ $college_career->code}} <br>
                @endforeach
            </td>
            <td>
            @foreach ($candidate->college_careers as $college_career)
                {{$college_career->name}} <br>
            @endforeach
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@if($pagination == true)
<div>
    <div class="float-left">
            Mostrando de {{ $candidates->firstItem()}} al  {{ $candidates->lastItem()}} de  {{ $candidates->total()}} registros 
    </div>
    <div class="float-right">
        {{$candidates->appends(Request::only(['college_id','sexo']))->render()}}   
    </div>
</div>
@endif