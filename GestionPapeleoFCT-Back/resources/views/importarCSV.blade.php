<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            hr{
                color: black;
            }
            div{
                margin-top:20px;
            }
            input[name=cicloCursoSeleccionado],input[name=idCursoSeleccionado]{
                display: none;
            }
        </style>
    </head>
    <body>

        <main class="container-fluid">
            <h1 class="text-center mt-5">Inserción CSV</h1>
            <div class="row">
                <div class="col-md-5 mx-auto border px-5 py-5">

                    <form method="POST" action="{{route('subirProfesores')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="profesores"><b>Profesores CSV: </b></label><br>
                        <input type="file" name="profesores" required>
                        <input class="btn btn-dark" type="submit" value="Enviar" >
                        <hr>        
                    </form>

                    <?php
                    echo 'Cursos restantes ' . count($cursos) . '<br>';
                    echo 'Curso seleccionado: ' . '' . $cursoSeleccionado->cicloFormativoA;
                    ?>
                    <form method="POST" action="cambiaCurso" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <select name="select_cursos">
                            @foreach ($cursos as $i => $curso)
                            @if($curso->id == $cursoSeleccionado->id)
                            <option selected value="{{ $curso->id }}">{{ $curso->cicloFormativoA }}</option>
                            @else
                            <option value="{{ $curso->id }}">{{ $curso->cicloFormativoA }}</option>
                            @endif
                            @endforeach
                        </select>
                        <input class="btn btn-dark" type="submit" value="Elegir" >
                    </form>
                    <hr>

                    <form method="POST" action="{{route('subirAlumnos')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="alumnos"><b>{{$cursoSeleccionado->cicloFormativoA}} CSV: </b></label><br>
                        <input type="text" name="cicloCursoSeleccionado" value="{{$cursoSeleccionado->cicloFormativoA}}" readonly/>
                        <input type="text" name="idCursoSeleccionado" value="{{$cursoSeleccionado->id}}" readonly/>
                        <input type="file" name="alumnos" required>
                        <input class="btn btn-dark" type="submit" value="Enviar" >
                        <hr>        
                    </form>

                </div>
            </div>
        </div>

    </main>
</body>
</html>
