<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mensaje</title>
    </head>
    <body style="background-color: #fff;color: #636b6f;font-family: 'Raleway', sans-serif;font-weight: bolder !important;margin: 0;width: 100%;">
        <div style=" width: 100%; height: 100%;">
            <div>
                <div>
                    <h2 style="margin:0px 0px 0px 0px;padding: 0px 0px 0px 20px;font-size: 30px; font-weight: bolder !important; background-color: #446c77 !important; color: white; width: 100%;"> {{ ucfirst($asunto) }}.</h2>
                </div>
                <div style="background-color: #eaeaea !important; color: black !important; padding: 20px 20px 20px 30px;height: 70px;">     
                    <h4 style="color: black !important;">Hola {{ $nombreUsuario }}, {{ $asunto }}.</h4>
                </div>
            </div>
        </div>
    </body>
</html>
