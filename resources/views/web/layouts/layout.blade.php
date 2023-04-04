<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://use.fontawesome.com/97a88bff0a.js"></script>
    <!-- <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" type="text/css" rel="stylesheet"> -->
    <title>Marc Shuttle</title>
    <!-- <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="azul-nav d-flex">
        <ul class="nav col">
            <li class="nav-item mr-3">
                <a href="#" class="text-white-menu nav-link">
                    <i class="fa fa-envelope" aria-hidden="true"></i> info@correo.com
                </a>
            </li>
            <li class="nav-item d-flex">
                <span class="text-white-menu nav-link">
                    {{__('Home.siguenos')}}
                </span>
                <a href="#" class="text-white-menu nav-link px-1">
                     <i class="fa fa-facebook" aria-hidden="true"></i> 
                </a>
                <a href="#" class="text-white-menu nav-link px-2">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="#" class="text-white-menu nav-link px-1">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
        <ul class="nav col row">
            <li class="nav-item" style="text-align:right;">
                <a class="nav-link text-white-menu" href="#">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> 768 Market Street San Francisco, CA 64015, United States
                </a>
            </li>
        </ul>
    </div>
    <nav class="transparent-nav d-flex">
        <div class="col-md-2 d-flex" style="align-items:center;">
            <img width="160" height="33" src="https://templatekits.themewarrior.com/transpo/wp-content/uploads/sites/64/2022/08/logo-light-transpo-1.png" alt="Logo">
        </div>
        <ul class="nav justify-content-end col-md-9" style="align-items:center;">
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="#">{{__('Home.home')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="#">{{__('Home.nuestros-camiones')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="#">{{__('Home.paginas')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg">{{__('Home.acerca-nosotros')}}</a>
            </li>
            <li class="mx-3">
                <a href="#" class="nav-link text-white-menu-lg">
                    <span class="back-orange"><i class="fa fa-phone" aria-hidden="true"></i></span> 001-234-5678
                </a>
            </li>
            <li>
                <div >
                    <button class="btn btn-outline-white">
                        {{__('Home.contactanos')}}
                    </button>
                </div>
            </li>
        </ul>
        
        <div class="d-flex col-md-1 mx-3" stlye="align-items-center;">
            <button class="btn" onclick="changeLenguage('{{App::getLocale()=='en'?'es':'en'}}')">
                @if (App::getLocale()=='es')
                  <img src="/img/assets/eng.png" alt="ingles" width="35" />
                @else
                  <img src="/img/assets/esp.png" alt="español" width="35" />
                @endif
            </button>
        </div>
    </nav>

    <div>
        @yield('content')        
    </div>
    <!-- <div class="div-angule">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="angule-blue">
            <path class="elementor-shape-fill" d="M500.2,94.7L0,0v100h1000V0L500.2,94.7z" style="transform-origin: center;transform: rotateY(0deg)"></path>
        </svg>
    </div> -->
    <div class="back-footer">
        <div class="row px-5 justify-content-center">
            <div class="col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.contactanos')}}</h4>
                <ul class="none-list">
                    <li class="text-gray fsize-sm">768 Market Street San Francisco, CA 64015, United States</li>
                    <li class="text-gray fsize-sm">customer@transpo.com</li>
                    <li class="text-gray fsize-sm">(+021) 345 678 910</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.informacion')}}</h4>
                <ul class="none-list">
                    <li class="text-gray fsize-sm">{{__('Home.acerca-nosotros')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.servicio-cliente')}}</li>
                    <li class="text-gray fsize-sm">Bus Type</li>
                    <li class="text-gray fsize-sm">{{__('Home.privacidad-politica')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.terminos-condiciones')}}</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.servicio-cliente')}}</h4>
                <ul class="none-list">
                    <li class="text-gray fsize-sm">{{__('Home.acerca-nosotros')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.servicio-cliente')}}</li>
                    <li class="text-gray fsize-sm">Order and returns</li>
                    <li class="text-gray fsize-sm">{{__('Home.contactanos')}}</li>
                    <li class="text-gray fsize-sm">Stor locations</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.metodo-pago')}}</h4>
                <i class="fa fa-cc-paypal text-white fa-2x" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <footer></footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    @stack('scripts')
</body>
</html>