<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Recipy</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Quicksand:300,500&display=swap');

    * {
      color: #424242;
      font-family: 'Quicksand', sans-serif;
    }

    body {
      margin: 1rem;
      text-align: justify;
    }

    header {
      border-bottom: 5px solid #f3a719;
      display: block;
      margin: auto;
      margin-bottom: 2rem;
      width: 100%;
    }

    .verify {
      color: #f3a719;
      font-size: 1.5rem;
    }

    .btn {
      border: 2px solid;
      border-color: #f3a719;
      border-radius: 50px;
      padding: 0.3rem 1.3rem;
      font-size: 1.1rem;
      transition: all 300ms;
      margin: 2rem auto;
    }

    .btn1 {
      background-color: #f3a719;
      color: white;
    }

    .btn1:hover {
      background-color: darken(#f3a719, 5%);
      border-color: darken(#f3a719, 5%);
    }
  </style>
</head>
<body>
  <header>
      <h3>Recipy Team</h3>
  </header>
  <main>
      Bienvenido {{ explode(' ', $user->name)[0] }}, <br>
      Gracias por crear una cuenta en Recipy. Estás a solo un paso de poder usarla.
      <br>Para verificar tu cuenta haz clic en el siguiente enlace: <br>
      
      <h2>
        <a href="{{ route('verify', ['token' => $user->verification_email_token]) }}" class="verify">
          Verificar e-mail
        </a>
      </h2>

      <br>

      <small>Si no has creado una cuenta en <a href="www.recipy.es">www.recipy.es</a> ignora este e-mail</small>
  </main>
</body>
</html>
