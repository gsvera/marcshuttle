@php
    $lang = App::getLocale();
    $prefijo = "";

    if($lang == 'en')
    {
        $prefijo = '/en/';
    }
    else{
        $prefijo = '/';
    }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.standalone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> -->
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
                    <i class="fa fa-envelope" aria-hidden="true"></i> info@transpo.com
                </a>
            </li>
            <!-- <li class="nav-item d-flex">
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
            </li> -->
        </ul>
        <ul class="nav col row">
            <li class="nav-item" style="text-align:right;">
                <a class="nav-link text-white-menu" href="#">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{__('Home.ubicacion-nav')}}
                </a>
            </li>
        </ul>
    </div>
    <nav class="transparent-nav d-flex" id="header">
        <div class="col-md-2 d-flex" style="align-items:center;">
            <img width="50%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
        </div>
        <ul class="nav justify-content-end col-md-9" style="align-items:center;">
            <li class="nav-item">
                <a href="{{url($prefijo)}}" class="nav-link text-white-menu-lg" href="#">{{__('Home.home')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="#">{{__('Home.destinos')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="#">Tours</a>
            </li>
            <!-- <li class="nav-item">
                <a href="{{url($prefijo.__('Link.about'))}}" class="nav-link text-white-menu-lg">{{__('Home.acerca-nosotros')}}</a>
            </li> -->
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
            <button class="btn" onclick="changeLenguage('{{$lang=='en'?'es':'en'}}')">
                @if ($lang=='es')
                  <img src="/img/assets/eng.png" alt="ingles" width="35" />
                @else
                  <img src="/img/assets/esp.png" alt="español" width="35" />
                @endif
            </button>
        </div>
    </nav>
    <!-- MENU PARA MOBILE -->
    <nav class="nav-mobile" id="navMobile">
        <div class="br-bt-gray col-12 d-flex py-3">
            <div class="col-2 justify-content-center align-center d-flex">
                <div>
                    <button class="btn btn-orange" onclick="ShowHideMenu()"><i id="icon-menu" class="fa fa-bars" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="col-4 d-flex align-center" style="align-items:center;">
                <img width="90%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
            </div>
            <div class="col-4 justify-content-center align-center d-flex">
                <button class="btn btn-outline-white">Request cuote</button>
            </div>
            <div class="d-flex col-1" stlye="align-items-center;">
                <button class="btn" onclick="changeLenguage('{{App::getLocale()=='en'?'es':'en'}}')">
                    @if (App::getLocale()=='es')
                    <img src="/img/assets/eng.png" alt="ingles" width="35" />
                    @else
                    <img src="/img/assets/esp.png" alt="español" width="35" />
                    @endif
                </button>
            </div>
        </div>
        <div class="sub-menu-hide" id="submenuhide" style="display:none;">
            <ul class="nav-mobile-hide">
                <li class="nav-item">
                    <a class="text-orange-menu" href="#">{{__('Home.home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="text-orange-menu" href="#">{{__('Home.destinos')}}</a>
                </li>
                <li class="nav-item">
                    <a class="text-orange-menu" href="#">Tours</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="text-orange-menu">{{__('Home.acerca-nosotros')}}</a>
                </li> -->
            </ul>
        </div>
    </nav>

    <!-- END MENU PARA MOBILE -->
    <div>
        @yield('content')        
    </div>
    <!-- <div class="div-angule">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="angule-blue">
            <path class="elementor-shape-fill" d="M500.2,94.7L0,0v100h1000V0L500.2,94.7z" style="transform-origin: center;transform: rotateY(0deg)"></path>
        </svg>
    </div> -->
    <div class="back-footer pt-5" style="bottom:0">
        <div class="row px-5 justify-content-center mx-0 col-12 col-md-12 mx-auto">
            <!-- <div class="col-md-1"></div> -->
            <div class="col-12 col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.translados-footer')}}</h4>
                <p class="text-gray fsize-sm text-justify">{{__('Home.text-footer')}}</p>                
            </div>
            <div class="col-12 col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.contactanos')}}</h4>
                <ul class="none-list">
                    <li class="text-gray fsize-sm">768 Market Street San Francisco, <br /> CA 64015, United States</li>
                    <li class="text-gray fsize-sm">customer@transpo.com</li>
                    <li class="text-gray fsize-sm">(+021) 345 678 910</li>
                </ul>
                <!-- <ul class="none-list">
                    <li class="text-gray fsize-sm">
                        
                        {{__('Home.acerca-nosotros')}}
                    </li>
                    <li class="text-gray fsize-sm">{{__('Home.servicio-cliente')}}</li>
                    <li class="text-gray fsize-sm">Bus Type</li>
                    <li class="text-gray fsize-sm">{{__('Home.privacidad-politica')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.terminos-condiciones')}}</li>
                </ul> -->
            </div>
            <div class="col-12 col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.enlaces')}}</h4>
                <ul class="none-list">
                    <li class="text-gray fsize-sm">{{__('Home.translado-zona-hotelera')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.translado-playa')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.traslado-tulum')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.traslado-bacalar')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.traslado-holbox')}}</li>
                    <li class="text-gray fsize-sm">{{__('Home.politicas-privacidad')}}</li>
                </ul>
            </div>
            <div class="col-12 col-md-2">
                <h4 class="text-white font-weight-bold">{{__('Home.metodo-pago')}}</h4>
                <i class="fa fa-cc-paypal text-white fa-2x mx-1" aria-hidden="true"></i>
                <i class="fa fa-money text-white fa-2x mx-1" aria-hidden="true"></i>
            </div>
            <!-- <div class="col-md-1"></div> -->
        </div>
        <div class="divider"></div>
        <div class="footer-extend py-4 px-5">
            <div class="col-12 col-md-6 text-silver px-5 fsize-sm font-weight-bold">
                © 2023 Marc Shuttle. Powered by Huella digital
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end px-5">
                <div class="text-center">
                    <img width="15%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
                </div>
            </div>
        </div>
        <div class="footer-extend-2">
            <div class="col-12 text-silver px-5 fsize-sm font-weight-bold text-center">
                © 2023 Marc Shuttle. Powered by Huella digital
            </div>
            <div class="col text-center py-3" style="align-items:center;">
                <img width="50%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
            </div>
        </div>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="{{ asset('js/jquery-3.3.1.js')}}"></script>
    <!-- <script src="{{ asset('js/bootstrap-datepicker.js')}}"></script> -->
    <script src="{{ asset('js/bootstrap-select.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->
    <script src="{{ asset('js/alerts.js')}}"></script>
    <script type="text/javascript">
        let countMenu = 1;
        $(function(){
            if(screen.width > 640){
                $(window).scroll(function(){
                    if($(window).scrollTop() > 20){
                        $('#header').removeClass('transparent-nav')
                        $('#header').addClass('transparent-nav-blue')
                    }
                    else if($(window).scrollTop() < 20){
                        $('#header').addClass('transparent-nav')
                        $('#header').removeClass('transparent-nav-blue')
                    }
                })
            }
            else if(screen.width < 640){
                $(window).scroll(function(){
                    if($(window).scrollTop() > 1){
                        $('#navMobile').removeClass('nav-mobile')
                        $('#navMobile').addClass('nav-mobile-blue')
                    }
                    else if($(window).scrollTop() < 1){
                        $('#navMobile').addClass('nav-mobile')
                        $('#navMobile').removeClass('nav-mobile-blue')
                    }
                })
                $('#footer-extend').css({'display':'none'})
            }
        })

        function ShowHideMenu()
        {            
            if(countMenu == 1)
            {
                $('#submenuhide').slideDown()
                $('#icon-menu').removeClass('fa-bars')
                $('#icon-menu').addClass('fa-times')
                countMenu = 0
            }
            else if(countMenu == 0){
                $('#submenuhide').slideUp()
                $('#icon-menu').addClass('fa-bars')
                $('#icon-menu').removeClass('fa-times')
                countMenu = 1
            }
        }

    </script>
    @stack('scripts')
</body>
</html>