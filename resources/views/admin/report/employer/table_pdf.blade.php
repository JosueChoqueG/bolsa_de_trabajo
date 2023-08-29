<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets_web/css/reports.css')}}">
 
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td> <img src="{{ asset('img/login/unamba-lite.png')}}" style="height: 33px;" ></td>
            <td style="text-align: center;"> 
                <div style="text-align: center; font-size: 13px;"> <b>BOLSA DE TRABAJO UNAMBA</b>
                    <br> <span style="font-size: 11px;"> LISTA DE EMPLEADORES REGISTRADOS</span>
                </div>
            </td>
            <td style="text-align: right;"><img src="{{ asset('img/principal/logo-bolsa-lite.png')}}" style="height: 28px;" ></td>
        </tr>
    </table>
    <table class="table table-sm table-bordered" style="padding-top: 10px;">
        <thead style="cursor:pointer">
            <tr class="cell">
                <th>N°</th>
                <th>RUC</th>
                <th>NOMBRE</th>
                <th>NOMBRE COMERCIAL</th> 
                <th>EMAIL</th>         					          				
                <th>SECTOR</th>
            </tr>
        </thead>
        <tbody id="list_employers" >
            @foreach($employers as $key => $employer)
            <tr id="{{ $employer->id }}">
                <td>{{$key+1}}</td>
                <td>{{$employer->ruc}}</td>
                <td>{{$employer->name}}</td>
                <td>{{$employer->tradename}}</td>
                <td>{{ $employer->email }}</td>
                <td>{{$employer->sector->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
