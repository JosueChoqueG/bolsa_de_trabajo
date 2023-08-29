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
                            <br> <span style="font-size: 11px;"> LISTA DE OFERTAS LABORALES</span>
                        </div>
                    </td>
                    <td style="text-align: right;"><img src="{{ asset('img/principal/logo-bolsa-lite.png')}}" style="height: 28px;" ></td>
                </tr>
            </table>
        <table class="table table-sm table-bordered" style="padding-top: 10px;">
        <thead >
            <tr class="cell">
                <th>N°</th>
                <th>TÍTULO</th>        					          				
                <th>CATEGORÍA</th>
                <th>ESTADO</th>
                <th>PROGRAMA</th>
                <th>CARRERA</th>
            </tr>
        </thead>
        <tbody id="table_body" >
            
            @foreach($job_offers as $key => $job_offer)
            <tr id="{{ $job_offer->id }}">
                <td>{{$key+1}}</td>
                <td>{{$job_offer->title}} {{$job_offer->title_complement}}</td>
                <td>{{$job_offer->category}}</td>
                <td> 
                    @if ($job_offer->status == 3)
                        <span class="">Cerrado</span>
                    @elseif($job_offer->status == 2)
                    <span class="">Publicado</span>
                    @else  
                    <span class="">En revisión</span>  
                    @endif
                </td>
                <td>
                    @foreach ($job_offer->college_careers as $college_career)
                        -{{$college_career->code}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach ($job_offer->college_careers as $college_career)
                        -{{$college_career->name}} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
