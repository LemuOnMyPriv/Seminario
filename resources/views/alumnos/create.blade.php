<!-- resources/views/items/alumnos.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Agregar Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h1>Registrar Alumnos</h1>
    <!-- Alert for Errors Messages -->
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('alumnos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre Alumno*</label>
            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Apellido Alumno*</label>
            <input type="text" name="lastname" class="form-control" id="lastname" value="{{old('lastname')}}">
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Correo Alumno*</label>
            <input type="email" name="mail" class="form-control" id="mail" value="{{old('mail')}}" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Edad Alumno*</label>
            <input type="number" name="age" class="form-control" id="age" value="{{old('age')}}" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</body>

</html>