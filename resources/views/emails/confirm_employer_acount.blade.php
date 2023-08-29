@component('mail::message')

Hola {{ $employer->name }}

Gracias por crear tu cuenta en **BOLSA DE TRABAJO UNAMBA**!! 

Tu solicitud esta siendo revisada, una vez sea aprobada,
podras ingresar con los siguientes datos.

**Email:**  {{ $employer->email }}  
**Contraseña:** {{  $password}}  

De esta forma podremos estar en contacto.  
Y si llegas a olvidar tu contraseña, la podrás recuperar a través de este correo. 
Saludos, y que estés bien !  

@component('mail::button', [ 'url' => $url ])
    IR A BOLSA DE TRABAJO UNAMBA
@endcomponent

Gracias,<br>
<small> OFICINA DE SEGUIMIENTO AL GRADUADO </small>

{{-- {{ config('app.name') }} --}}
@endcomponent
