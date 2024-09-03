<?php
    use Carbon\Carbon;
    use App\Models\ResetPassword;

    $resetPassword = new ResetPassword;
    $tokenValid = $resetPassword->_ValidToken($token);

?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="col-md-6 col-lg-6 align-center mx-auto mt-5 row">
                    <img src="/img/logos/logo-marcshuttle-black.png" alt="login form" class="img-fluid invert-color-logo" style="width:80%">
                </div>
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="">
                            <div class="">
                                <div class="px-4 py-5">
                                    @if($tokenValid == true)
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Ingrese una nueva contraseña</h1>
                                        <p>La contraseña debe contener por lo menos una mayuscula, una minuscula y un numero.</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user text-center" id="newPassword">
                                        </div>
                                        <button type="button" onclick="saveNewPassword()" id="btnSave" class="btn btn-primary btn-user btn-block">
                                            Cambiar contraseña
                                        </button>
                                    </form>
                                    @else
                                    <div class="text-center font-weight-bold">
                                        <p>El token para recuperar su contraseña ha caducado.</p>
                                        <br />
                                        <a href="/admin-marcshuttle/login" class="btn btn-secondary btn-sm">Ir al login</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script type="text/javascript">
        function saveNewPassword()
        {
            if(!regexPassword.test($('#newPassword').val())) {
                notification('error', 'Ingrese una contraseña valida');
                return false;
            }
            var btnSave = document.getElementById('btnSave');
            btnSave.setAttribute('disabled', 'true');
            activeLoader('Guardando...', 'Actualizando su contraseña')
            fetch('/admin-marcshuttle/save-new-reset-password',{
                method: 'POST',
                headers: headConexion,
                body: JSON.stringify({newPassword: $('#newPassword').val(), token: '{{$token}}' })
            })
            .then(res => res.json())
            .then(result => {
                closeAlert();
                if(result.error == false) {
                    notification('success', 'Se actualizo la contraseña correctamente.');
                    setTimeout(() => {
                        window.location.href = '/admin-marcshuttle/login';
                    },3000)
                    $('#newPassword').val('')
                } else {
                    notification('error', result.Message);
                }
            })
        }
    </script>
</body>
</html>