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
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-54PBCMK');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2C8389YX67"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2C8389YX67');
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(94095721, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/94095721" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.standalone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
    <script type="text/javascript" src="/js/intlTelInput.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> -->
    <script src="https://use.fontawesome.com/97a88bff0a.js"></script>
    <!-- <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" type="text/css" rel="stylesheet"> -->
    <title>Marc Shuttle</title>
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
    @yield('metas')

    @yield('headers')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="qJcq3XfUMapwFRCDFnO3dJ3DlOAWxnw-yDq5TCEnUbM" />
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54PBCMK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="azul-nav d-flex">
        <ul class="nav col">
            <li class="nav-item mr-3">
                <a href="mailto:marcshuttlec@gmail.com" class="text-white-menu nav-link">
                    <i class="fa fa-envelope" aria-hidden="true"></i> marcshuttlec@gmail.com
                </a>
            </li>
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
            <a href="{{$prefijo}}">
                <img width="50%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
            </a>
        </div>
        <ul class="nav justify-content-end col-md-9" style="align-items:center;">
            <li class="nav-item">
                <a href="{{url($prefijo)}}" class="nav-link text-white-menu-lg">{{__('Home.home')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="javascript:void(0)">{{__('Home.destinos')}}</a>
                <ul class="sub-menu">
                    <li><a class="text-white-menu-lg font-weight-bold" style="text-decoration:none;" href="{{__('Playa.url')}}">Playa del carmen</a></li>
                    <li><a class="text-white-menu-lg font-weight-bold" style="text-decoration:none;" href="{{__('Tulum.url')}}">Tulum</a></li>
                    <li><a class="text-white-menu-lg font-weight-bold" style="text-decoration:none;" href="{{url(__('Bacalar.url'))}}">Bacalar</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white-menu-lg" href="{{url(__('Tours.url'))}}">Tours</a>
            </li>
            <li class="mx-3">
                <a href="tel:9981224280" class="nav-link text-white-menu-lg">
                    <span class="back-orange"><i class="fa fa-phone" aria-hidden="true"></i></span> +52 998-122-4280
                </a>
            </li>
            <li>
                <div >
                    <a class="btn btn-outline-white" href="#motorbusqueda" id="btbMenuBook">
                        {{__('Home.btn-menu-reserva')}}
                    </a>
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
            <div class="col-4 d-flex justify-content-center">
                <a href="{{$prefijo}}">
                    <img width="90%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
                </a>
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
                    <a class="text-orange-menu" href="{{url($prefijo)}}">{{__('Home.home')}}</a>
                </li>
                <li class="nav-item sub-menu-hv">
                    <a class="text-orange-menu" href="javascript:void(0)">{{__('Home.destinos')}}</a>
                    <ul class="sub-menu-mb">
                        <li><a class="text-gray font-weight-bold" style="text-decoration:none;" href="{{url(__('Playa.url'))}}">Playa del carmen</a></li>
                        <li><a class="text-gray font-weight-bold" style="text-decoration:none;" href="{{url(__('Tulum.url'))}}">Tulum</a></li>
                        <li><a class="text-gray font-weight-bold" style="text-decoration:none;" href="{{url(__('Bacalar.url'))}}">Bacalar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="text-orange-menu" href="{{url(__('Tours.url'))}}">Tours</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- END MENU PARA MOBILE -->
    <div>
        @yield('content')        
    </div>
    
    <div class="triangule-blue"></div>
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
                    <li class="fsize-sm">
                        <a href="mailto:marcshuttlec@gmail.com" class="text-gray-link without-link">
                            marcshuttlec@gmail.com
                        </a>
                    </li>
                    <li class="text-gray fsize-sm">
                        <a href="tel:9981224280" class="text-gray-link without-link">
                            (+52) 998 122 4280
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-3">
                <h4 class="text-white font-weight-bold">{{__('Home.enlaces')}}</h4>
                <ul class="none-list">
                    <li class="text-gray fsize-sm">
                        <a href="{{url(__('Playa.url'))}}" class="text-gray-link fsize-sm without-link">
                            {{__('Home.translado-playa')}}
                        </a>
                    </li>
                    <li class="text-gray fsize-sm">
                        <a href="{{url(__('Tulum.url'))}}" class="text-gray-link fsize-sm without-link">
                            {{__('Home.traslado-tulum')}}
                        </a>
                    </li>
                    <li class="text-gray fsize-sm">
                        <a href="{{url(__('Bacalar.url'))}}" class="text-gray-link fsize-sm without-link">
                            {{__('Home.traslado-bacalar')}}
                        </a>
                    </li>
                    <li class="text-gray fsize-sm">
                        <a href="{{url(__('Tours.url'))}}" class="text-gray-link fsize-sm without-link">
                            Tours
                        </a>
                    </li>
                    <li class="text-gray fsize-sm">
                        <a href="#" class="text-gray-link fsize-sm without-link">
                            {{__('Home.politicas-privacidad')}}
                        </a>
                    </li>
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
            <div class="col-12 col-md-6">
                <a href="https://huella-digital.mx/" class="text-gray-link px-5 fsize-sm font-weight-bold without-link">
                    © 2023 Marc Shuttle. Powered by Huella digital
                </a>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end px-5">
                <div class="text-center">
                    <a href="{{$prefijo}}">
                        <img width="15%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-extend-2">
            <div class="col-12 text-center">
                <a href="https://huella-digital.mx/" class="text-gray-link px-5 fsize-sm font-weight-bold without-link">
                    © 2023 Marc Shuttle. Powered by Huella digital
                </a>
            </div>
            <div class="col text-center py-3" style="align-items:center;">
            <a href="{{$prefijo}}">
                <img width="50%" src="/img/logos/Logo-Marcshuttle.webp" alt="Logo">
            </a>
            </div>
        </div>
    </div>
    <a rel="nofollow" target="_blank" style="text-decoration:none;" href="https://wa.me/+529981224280">
        <img class="chat-icon" src="/img/icons/whatsapp-icon.png" alt="icono chat whatsapp">
    </a>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- <script src="{{ asset('js/jquery-3.3.1.js')}}"></script> -->
    <script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
    <!-- <script src="{{ asset('js/bootstrap-select.js')}}"></script> -->
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