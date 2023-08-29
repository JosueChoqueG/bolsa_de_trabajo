@component('mail::message')

Hola {{ $candidate->name }}

Gracias por crear tu cuenta en **BOLSA DE TRABAJO UNAMBA**

Tus datos de acceso son los siguientes.

**Email:**  {{ $candidate->email }}  
**Contraseña:** {{  $password}}  

Lo primero que debes hacer es confirmar tu correo electrónico haciendo clic en el siguiente enlace,

@component('mail::button', [ 'url' => $url.'/confirmAcount/'.$candidate->document.'/candidate' ])
    Clic para confirmar tu email
@endcomponent

De esta forma podremos estar en contacto.

Y si llegas a olvidar tu contraseña, la podrás recuperar a través de este correo.

Saludos, y que estés bien !

Gracias,<br>
<small> OFICINA DE SEGUIMIENTO AL GRADUADO </small>

{{-- {{ config('app.name') }} --}}
@endcomponent
