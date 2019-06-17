<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Recipy | Usuarios</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<h2>Listado de usuarios</h2>

  <table class="table table-sm table-striped">
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Registro</th>
        <th>Cuenta</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->nick }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                <td>
                  {{ $user->enabled ? 'Activa' : 'Suspendida'}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
  
</body>
</html>