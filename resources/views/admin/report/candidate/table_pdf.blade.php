<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets_web/css/reports.css')}}">
</head>
<body >
   
    <table style="width: 100%;">
        <tr>
            <td> <img src="{{ asset('img/login/unamba-lite.png')}}" style="height: 33px;" ></td>
            <td style="text-align: center;"> 
                <div style="text-align: center; font-size: 13px;"> <b>BOLSA DE TRABAJO UNAMBA</b>
                    <br> <span style="font-size: 11px;"> LISTA DE USUARIOS REGISTRADOS</span>
                </div>
            </td>
            <td style="text-align: right;"><img src="{{ asset('img/principal/logo-bolsa-lite.png')}}" style="height: 28px;" ></td>
        </tr>
    </table>
    
    <table class="table table-sm table-bordered" style="padding-top: 10px;">
        <thead >
            <tr class="cell">
                <th>N°</th>
                <th>DNI</th>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>          					          				
                <th>SEXO</th>
                <th>EMAIL</th>
                <th>PROGRAMA</th>
                <th>CARRERA</th>
            </tr>
        </thead>
        <tbody id="list_candidates" >
            
            @foreach($candidates as $key => $candidate)
            <tr id="{{ $candidate->id }}" >
                <td>{{$key+1}}</td>
                <td>{{$candidate->document}}</td>
                <td>{{$candidate->name}}</td>
                <td>{{$candidate->first_lastname}} {{$candidate->second_lastname}}</td>
                <td>{{$candidate->gender}}</td>
                <td>{{$candidate->email }}</td>
                <td>
                    @foreach ($candidate->college_careers as $college_career)
                            - {{ $college_career->code}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach ($candidate->college_careers as $college_career)
                        - {{ $college_career->name}} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
