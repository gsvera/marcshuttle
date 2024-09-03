<html lang="en"><head>

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
                                    <div>
                                        <a href="./login" class="btn btn-sm">
                                            <i class="fa fa-arrow-left fa-1x" aria-hidden="true"></i> Regresar
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu contraseña?</h1>
                                        <p class="mb-4">
                                            Ingresa tu email y te enviaremos un link para restablecer tu contraseña
                                        </p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" placeholder="Ingresa tu email...">
                                        </div>
                                        <button type="button" onclick="sendMail()" class="btn btn-primary btn-user btn-block">
                                            Restablecer contraseña
                                        </button>
                                    </form>
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
        function sendMail()
        {
            if(!regex.test($('#email').val())) {
                notification('error', 'Ingrese un email valido');
                return false;
            }
            activeLoader('Enviando correo', 'Generando token de recuperación');
            fetch('/admin-marcshuttle/send-token-reset-password',{
                method: 'POST',
                headers: headConexion,
                body: JSON.stringify({email: $('#email').val()})
            })
            .then(res => res.json())
            .then(result => {
                closeAlert();
                if(result.error == false) {
                    notification('success', 'Se ha enviado un correo a su cuenta para restablecer la contraseña, favor de revisar su bandeja.');
                    $('#email').val('')
                } else {
                    notification('error', result.Message);
                }
            })
        }
    </script>
</body>
</html>