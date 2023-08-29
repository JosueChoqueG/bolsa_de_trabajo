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
                    <h6> empleadores registrados</h6>
                    {{-- @if($status != null && $sector != null )
                    <small class="text-muted">(empleadores registrados del sector {{$sector->name}} que se encuentran en estado: {{$status}})</small>
                    @endif
                    @if($status == null && $sector != null )
                    <small class="text-muted">(empleadores registrados del sector {{$sector->name}})</small>
                    @endif
                    @if($status != null && $sector == null  )
                    <small class="text-muted">(empleadores registrados que se encuentran en estado: {{$status}})</small>
                    @endif --}}
                </th>
                <th style="width:10%">
                    {{-- <img src="{{ asset('img/login/unamba.png')}}" style="height: 35px;" > --}}
                </th>
            </tr>
        </thead>
    </table>
    @endif
@endif
<table class="table  table-sm table-hover  table-bordered table-border" >
    <thead style="cursor:pointer">
        <tr>
            <th>Ruc</th>
            <th>Nombre</th>
            <th>Nombre comercial</th> 
            <th style="width: 30%;">Act. Económica(s)</th>         					          				
            <th>Sector</th>
        </tr>
    </thead>
    <tbody id="list_employers" >
        @foreach($employers as $employer)
        <tr id="{{ $employer->id }}">
            <td>{{$employer->ruc}}</td>
            <td>{{$employer->name}}</td>
            <td>{{$employer->tradename}}</td>
            <td>{{trim($employer->economic_activity,'[]')}}</td>
            <td>{{$employer->sector->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@if($pagination == true)   
    <div>
    <div class="float-left">
        Mostrando de {{ $employers->firstItem()}} al  {{ $employers->lastItem()}} de  {{ $employers->total()}} registros 
    </div>
    <div class="float-right">
        {{$employers->appends(Request::only(['sector_id','status']))->render()}}   
    </div>
    </div>
@endif