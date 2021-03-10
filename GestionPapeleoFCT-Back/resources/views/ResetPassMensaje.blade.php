<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mensaje</title>
    </head>
    <body style="background-color: #eaeaea;color: black;font-family: 'Raleway', sans-serif;font-weight: bolder !important;margin: 0;width: 100%;">
        <div style=" width: 100%; height: 100%;">
            <div>
                <div>
                    <h2 style="margin:0px 0px 0px 0px;padding: 0px 0px 0px 20px;font-size: 30px; font-weight: bolder !important; background-color: #446c77 !important; color: white; width: 100%;"> {{ ucfirst($asunto) }}.</h2>
                </div>
                <div style="background-color: #eaeaea !important; color: black !important; padding: 20px 20px 20px 30px;min-height: 100px;">   
                    <h3 style="color: black !important;">Si tu no has olvidado tu contraseña <strong>IGNORA</strong> este mensaje.</h3>
                    <h4 style="color: black !important;">Hola {{ $email }}, este es tu correo para {{ $asunto }}.</h4>
                    <a href="{{ $link }}" rel="noopener" style="font-size: 17px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#446c77;border-bottom:8px solid #446c77;border-left:18px solid #446c77;border-right:18px solid #446c77;border-top:8px solid #446c77" target="_blank">Cambiar contraseña</a>
                    <br>
                    <h4 style="color: black !important;">Si tienes problemas con el link copia y pega esto en tu navegador <a>{{ $link }}</a> .</h4>
                </div>
            </div>
        </div>
    </body>
</html>
