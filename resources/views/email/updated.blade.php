Hola {{ $user->name }}, 
Hemos detectado que has cambiado el email de tu cuenta.
Para verificar el cambio haz clic en el siguiente enlace:
{{ route('verify', ['token' => $user->verification_email_token]) }}
