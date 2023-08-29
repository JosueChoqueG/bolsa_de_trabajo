
<br>
<tr ><th style="text-align: center; font-weight: bold; font-size:14px;" colspan="7" > LISTA DE EMPLEOS REGISTRADOS</th></tr>
<br>
<table class="table  table-sm table-hover  table-bordered table-border" >
    <thead style="cursor:pointer">
        <tr>
            <th style="width: 40px; border: 1px solid #000000; font-weight: bold;">Título</th>        					          				
            <th style="width: 20px; border: 1px solid #000000; font-weight: bold;">Tipo</th>
            <th style="width: 20px; border: 1px solid #000000; font-weight: bold;">Categoría</th>
            <th style="width: 15px; border: 1px solid #000000; font-weight: bold;">Estado</th>
            <th style="width: 20px; border: 1px solid #000000; font-weight: bold;">Cod. Carreras</th>
        </tr>
    </thead>
    <tbody id="table_body" >
        
        @foreach($job_offers as $job_offer)
        <tr id="{{ $job_offer->id }}">
            <td style="border: 1px solid #000000;">{{$job_offer->title}} {{$job_offer->title_complement}}</td>
            <td style="border: 1px solid #000000;">{{$job_offer->type}}</td>
            <td style="border: 1px solid #000000;">{{$job_offer->category}}</td>
            
            <td style="border: 1px solid #000000;"> 
                @if ($job_offer->status == 3)
                    <span class="badge badge-secondary">Cerrado</span>
                @elseif($job_offer->status == 2)
                <span class="badge badge-success">Publicado</span>
                @else  
                <span class="badge badge-warning">En revisión</span>  
                @endif
            </td>
            <td style="border: 1px solid #000000;">
                @foreach ($job_offer->college_careers as $college_career)
                    {{$college_career->code}} <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>