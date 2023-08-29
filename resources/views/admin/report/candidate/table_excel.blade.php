

    <br>
    <tr ><th style="text-align: center; font-weight: bold; font-size:14px;" colspan="7" > LISTA DE ESTUDIANTES REGISTRADOS</th></tr>
    <br>
    <table>
    <thead >
        <tr style="font-weight: bold;">
            <th style="border: 1px solid #000000; font-weight: bold;" >N°</th>
            <th style="width: 10px; border: 1px solid #000000; font-weight: bold;">DNI</th>
            <th style="width: 30px; border: 1px solid #000000; font-weight: bold;">Nombre</th>
            <th style="width: 30px; border: 1px solid #000000; font-weight: bold;">Apellidos</th>          					          				
            <th style="border: 1px solid #000000; font-weight: bold;">Sexo</th>
            <th style="width: 40px; border: 1px solid #000000; font-weight: bold;" >Programa de estudios</th>
            <th style="width: 40px; border: 1px solid #000000; font-weight: bold;" >Carrera</th>
            <th style="width: 40px; border: 1px solid #000000; font-weight: bold;" >Estado Civil</th>
            <th style="width: 40px; border: 1px solid #000000; font-weight: bold;" >Correo</th>
            <th style="width: 40px; border: 1px solid #000000; font-weight: bold;" >Teléfono</th>
        </tr>
    </thead>
    <tbody>
        @foreach($candidates as $key => $candidate)
        <tr>
            <td style="border: 1px solid #000000;">{{$key+1}}</td>
            <td style="border: 1px solid #000000;">{{$candidate->document}}</td>
            <td style="border: 1px solid #000000;">{{$candidate->name}}</td>
            <td style="border: 1px solid #000000;">{{$candidate->first_lastname}} {{$candidate->second_lastname}}</td>
            <td style="border: 1px solid #000000;">{{$candidate->gender}}</td>
            <td style="border: 1px solid #000000;">
                @foreach ($candidate->college_careers as $college_career)
                        - {{ $college_career->code}} <br>
                @endforeach
            </td>
            <td style="border: 1px solid #000000;">
            @foreach ($candidate->college_careers as $college_career)
                {{$college_career->name}}<br>
            @endforeach
            </td>
            <td style="border: 1px solid #000000;">{{$candidate->civil_status}}</td>
            <td style="border: 1px solid #000000;">{{$candidate->email}}</td>
            <td style="border: 1px solid #000000;">{{$candidate->first_phone}}</td>

        </tr>
        @endforeach
    </tbody>
</table>