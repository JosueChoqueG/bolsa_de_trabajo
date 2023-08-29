<br>
<tr ><th style="text-align: center; font-weight: bold; font-size:14px;" colspan="7" > LISTA DE EMPLEADORES REGISTRADOS</th></tr>
<br>
<table class="table  table-sm table-hover  table-bordered table-border" >
    <thead style="cursor:pointer">
        <tr>
            <th style="width: 15px; border: 1px solid #000000; font-weight: bold;">Ruc</th>
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Nombre</th>
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Nombre comercial</th>          					          				
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Dirección</th>          					          				
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Actividad(es) Económica(s)</th>          					          				
            <th style=" width: 20px; border: 1px solid #000000; font-weight: bold;">Sector</th>
            <th style=" width: 20px; border: 1px solid #000000; font-weight: bold;">Descripción</th>
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">correo</th>  
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Contacto</th>          					          				
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Cargo del contacto</th>          					          				
            <th style="width: 50px; border: 1px solid #000000; font-weight: bold;">Telefono del contacto</th>          					          				


        </tr>
    </thead>
    <tbody id="list_employers" >
        @foreach($employers as $employer)
        <tr id="{{ $employer->id }}">
            <td style="border: 1px solid #000000;">{{$employer->ruc}}</td>
            <td style="border: 1px solid #000000;">{{$employer->name}}</td>
            <td style="border: 1px solid #000000;">{{$employer->tradename}}</td>
            <td style="border: 1px solid #000000;">{{$employer->address}}</td>
            <td style="border: 1px solid #000000;">{{trim($employer->economic_activity,'[]')}}</td>
            <td style="border: 1px solid #000000;">{{$employer->sector->name}}</td>
            <td style="border: 1px solid #000000;">{{$employer->description}}</td>
            <td style="border: 1px solid #000000;">{{$employer->email}}</td>
            <td style="border: 1px solid #000000;">{{$employer->contact_name.' '.$employer->contact_lastname}}</td>
            <td style="border: 1px solid #000000;">{{$employer->contact_role}}</td>
            <td style="border: 1px solid #000000;">{{$employer->contact_first_phone}}</td>
        </tr>
        @endforeach
    </tbody>
</table>