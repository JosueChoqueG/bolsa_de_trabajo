@component('mail::message')

Hola **{{ $name}}**

Recibimos una solicitud para restablecer tu contraseña.
Puedes cambiar la contraseña directamente en el siguiente enlace.  

@component('mail::button', [ 'url' => $url ])
    Cambiar contraseña
@endcomponent

Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.

Saludos,<br>
<small> OFICINA DE SEGUIMIENTO AL GRADUADO </small>

{{-- {{ config('app.name') }} --}}
@endcomponent
