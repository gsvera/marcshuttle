<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password marcshuttle</title>
    <style>
        span, strong, h1, div{
            font-family: sans-serif;
        }
        .card-marcshuttle {
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.5);
            margin: auto;
            color: gray;
            font-weight: bold;
            width: 350px;
            text-align: justify;
            background-color: white;
        }
        .link-marcshuttle {
            color: gray;
        }
    </style>
</head>
<body>
    <div style="background-color: #355CCC; padding: 50px;">
        <div class="card-marcshuttle">
            Hola {{$nombre}}, se solicto un cambio de contraseña, a continuacion ingrese al siguiente link para cambiar su contraseña, si usted no realizo esta solicitud favor de ignorar este mensaje.
            <br />
            <br />
            <div style="text-align: center;">
                <a class="link-marcshuttle" href="{{$link}}">De click aqui</a>
            </div>
        </div>
        <div>
        </div>
    </div>
</body>
</html>