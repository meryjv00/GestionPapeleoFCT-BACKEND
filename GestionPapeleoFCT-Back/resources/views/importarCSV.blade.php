<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            hr{
                color: black;
            }
        </style>
    </head>
    <body>
        <h1>Inserción CSV</h1>
        <form method="POST" action="{{route('subir')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="profesores"><b>Profesores CSV: </b></label><br>
            <input type="file" name="profesores" required>
            <hr>
            <label for="alumnos2DAW"><b>Alumnos 2DAW CSV: </b></label><br>
            <input type="file" name="alumnos2DAW" required>
            <hr>
            <label for="alumnos2DAM"><b>Alumnos 2DAM CSV: </b></label><br>
            <input type="file" name="alumnos2DAM" required>
            <hr> 
            <label for="alumnos2ASIR"><b>Alumnos 2ASIR CSV: </b></label><br>
            <input type="file" name="alumnos2ASIR" required>
            <hr>
            <input class="btn btn-success" type="submit" value="Enviar" >
        </form>
    </body>
</html>
