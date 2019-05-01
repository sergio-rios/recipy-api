Hola {{ $user->name }}, 
Gracias por crear una cuenta en Recipy. Estás a solo un paso de poder usarla.
Para verificar tu cuenta haz clic en el siguiente enlace:
{{ route('verify', ['token' => $user->verification_email_token]) }}
