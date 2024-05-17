@extends('web.layouts.layout')

@section('metas')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{{__('Meta.index-title')}}"> 
    <meta name="description" content="{{__('Meta.index-descripcion')}}">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="safe for kids">
    <meta name="language" content="{{__('Meta.index-lenguage')}}">
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="{{__('Meta.index-title-og')}}">
    <meta property="og:url" content="https://marcshuttlecancun.com/">
    <meta property="og:image" content="https://marcshuttlecancun.com/img/banners/servicio-de-traslado-en-cancun-aeropuerto.webp">
    <meta property="og:description" content="{{__('Meta.index-descripcion-og')}}">
    <meta property="business:contact_data:street_address" content="Aeropuerto de Cancún">
    <meta property="business:contact_data:locality" content="Cancún">
    <meta property="business:contact_data:region" content="Quintana roo">
    <meta property="business:contact_data:postal_code" content="77500">
    <meta property="business:contact_data:country_name" content="Mexico">
@endsection

@section('content')
    <div class="layer-home back-slider-home"></div>
    <div class="row mt-4 elementup m-0">
        <div class="col-12 col-md-6 row div-principal" >
            <div>
                <p class="text-cian ls2 font-weight-bold">{{__('Home.transportacion-slogan')}}</p>
                <h1 class="font-weight-bold text-white fsize-xl">{{__('Home.titulo-inicio')}}</h1>
                <p class="font-weight-bold text-white">{{__('Home.texto-principal')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div id="motorbusqueda"></div>
        </div>        
    </div>
    <div class="row col-md-11 mx-auto mt-5 elementup back-home-mobile">
        <div class="col-12 col-md-3 my-2">
            <div class="card-white row">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/book-confirm.png" alt="book confirm"></span>
                </div>
                <p class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.reserva-rapida')}}</p>
                <p class="text-gray">{{__('Home.reserva-rapida-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white row">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/verified_user.png" alt="virified user"></span>
                </div>
                <p class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.transporte-privado')}}</p>
                <p class="text-gray">{{__('Home.transporte-privato-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/book-confirm.png" alt="currency exchange"></span>
                </div>
                <p class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.rastreo-vuelo')}}</p>
                <p class="text-gray">{{__('Home.rastreo-vuelo-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/currency_exchange.png" alt="currency exchange"></span>
                </div>
                <p class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.mejor-precio')}}</p>
                <p class="text-gray">{{__('Home.mejor-precio-text')}}</p>
            </div>
        </div>
    </div>
    
    <div class="section">
        <div class="banner-driver">
            <div class="">
                <div class="col-12 col-md-6 row"  style="padding:5% 0 5% 5%;">
                    <div class="text-blue ls2 font-weight-bold">{{__('Home.titulo-servicio-usted')}}</div>
                    <h2 class="font-weight-bold fsize-md">{{__('Home.titulo-marc-translados')}}</h2>
                    <div class="line-sm-blue my-2" style="margin-left: calc(var(--bs-gutter-x) * 0.5);"></div>                    
                    <p class="text-gray fsize-sm mb-3">{{__('Home.texto-marc-uno')}}</p>
                    <p class="text-gray fsize-sm">{{__('Home.texto-marc-dos')}}</p>                
                </div>
            </div>
            <div>
                <img class="img-driver-mobile" src="/img/banners/driver.jpg" alt="Driver">
            </div>
        </div>
    </div>
    <div class="banner-lineal">
        <div class="bg-blue">
            <div class="text-center" style="padding:100px 50px">
                <div class="text-white ls2 font-weight-bold">{{__('Home.autobus-slogan')}}</div>
                <h2 class="text-white font-weight-bold fsize-md">{{__('Home.autobus-titulo')}}</h2>
                <div class="line-sm-white my-3 mx-auto"></div>
                <div class="col-12 col-md-7 mx-auto">
                    <p class="text-white fsize-sm">{{__('Home.autobus-texto-uno')}}</p>
                </div>
                <div class="mb-5">
                    <div class="row col-12 col-md-12 mt-5 mx-0 justify-content-center">
                        <div class="col-12 col-md-3 p-2">
                            <div class="card-bus pt-3">
                                <h3 class="font-weight-bold text-center">Toyota</h3>                                
                                <ul class="without-list text-left pl-4">
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('Home.toyota-detalle')}}   
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.aa')}}
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.agua-pasajero')}}
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.cargadores-usb')}}
                                    </li>
                                </ul>
                                <img src="/img/assets/Toyota.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:80%;">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 p-2">
                            <div class="card-bus text-center pt-3">
                                <h3 class="font-weight-bold">Transporter</h3>
                                <ul class="without-list text-left pl-4">
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('Home.transporter-detalle')}}   
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.aa')}}
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.agua-pasajero')}}
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.cargadores-usb')}}
                                    </li>
                                </ul>
                                <img src="/img/assets/Transporter.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:80%;">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 p-2">
                            <div class="card-bus text-center pt-3">
                                <h3 class="font-weight-bold">Sprinter</h3>
                                <ul class="without-list text-left pl-4">
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('Home.sprinter-detalle')}}   
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.aa')}}
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.agua-pasajero')}}
                                    </li>
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.cargadores-usb')}}
                                    </li>
                                </ul>
                                <img src="/img/assets/Sprinter.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:80%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="col-12 col-md-8 text-center mx-auto">
            <div class="text-blue ls2 font-weight-bold">{{__('Home.translados-slogan')}}</div>
            <h2 class="font-weight-bold fsize-md">{{__('Home.mejor-opcion-titulo')}}</h2>
            <div class="line-sm-blue my-3 mx-auto"></div>
            <p class="text-gray fsize-sm">{{__('Home.mejor-opcion-texto-uno')}}</p>
        </div>
        <div class="col-12 col-md-10 row justify-content-center mx-auto mt-5">
            <div class="col-6 col-md-3 text-center my-3">
                <img src="/img/logos/logo-visita-mexico.webp" class="logo-home" alt="logo">
            </div>
            <div class="col-6 col-md-3 text-center my-3">
                <img src="/img/logos/logo-verified-paypal.webp" class="logo-home-circle" alt="logo">
            </div>
            <div class="col-6 col-md-3 text-center my-3">
                <img src="/img/logos/empresa-traslados-cancun-registro.webp" class="logo-home" alt="logo">
            </div>
            <div class="col-6 col-md-3 text-center my-3">
                <img src="/img/logos/logo-ssl-secure-website.webp" class="logo-home-circle" alt="logo">
            </div>
        </div>
    </div>    
    </div>
    <div class="section">
        <div class="row m-0">
            <div class="bg-zona-hotelera col-12 col-sm-7 col-md-9 p-0">
                <div class="bg-zona-hotelera-shadow">
                    <div class="col-11 col-md-8 mx-auto align-center justify-content-center d-flex" style="height:100%;">
                        <div>
                            <div class="text-white font-weight-bold ls2">{{__('Home.viajero-slogan')}}</div>
                            <h2 class="text-white fsize-md font-weight-bold">{{__('Home.titulo-viajero')}}</h2>
                            <div class="line-sm-white my-3"></div>
                            <p class="text-white">{{__('Home.viajeto-texto-uno')}}</p>
                            <ul class="none-list">
                                <li class="text-white font-weight-bold">1. {{__('Home.viajero-list-uno')}}</li>
                                <li class="text-white font-weight-bold">2. {{__('Home.viajero-list-dos')}}</li>
                                <li class="text-white font-weight-bold">3. {{__('Home.viajero-list-tres')}}</li>
                            </ul>
                            <p class="text-white">{{__('Home.viajero-texto-dos')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-3 text-center align-center flex-desk">
                <img class="img-person" src="/img/assets/empresa-traslados-cancun.webp" alt="Persona">
            </div>
        </div>
    </div>
    <div class="section">
        <div class="col-md-7 mx-auto text-center">
            <div class="text-blue font-weight-bold ls2">{{__('Home.destino-slogan')}}</div>
            <h2 class="font-weight-bold fsize-md">{{__('Home.destinos-favoritos')}}</h2>
            <div class="line-sm-blue my-3 mx-auto"></div>
            <p class="text-gray fsize-sm">{{__('Home.destinos-texto-uno')}}</p>
        </div>
        <div class="bg-destination">
            <div class="row col-md-11 mx-auto mt-5 justify-content-center" style="padding-bottom: 100px;">             
                <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/assets/playa-del-carmen-min.webp" alt="transporte traslado playa del carmen" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h3 class="font-weight-bold fsize-sm">Playa del Carmen</h3>
                            <p class="text-gray font-weight-bold">{{__('Home.destination-text-dos')}}</p>
                            <a href="{{url(__('Playa.url'))}}" class="without-link text-orange font-weight-bold fsize-xs">{{__('Home.ver-mas')}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/assets/tulum.webp" alt="transporte-tulum" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h3 class="font-weight-bold fsize-sm">Tulum</h3>
                            <p class="text-gray font-weight-bold">{{__('Home.destination-text-tres')}}</p>
                            <a href="{{url(__('Tulum.url'))}}" class="without-link text-orange font-weight-bold fsize-xs">{{__('Home.ver-mas')}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/assets/bacalar.webp" alt="transporte traslado" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h3 class="font-weight-bold fsize-sm">Bacalar</h3>
                            <p class="text-gray font-weight-bold">{{__('Home.destination-test-cuatro')}}</p>
                            <a href="{{url(__('Bacalar.url'))}}" class="without-link text-orange font-weight-bold fsize-xs">{{__('Home.ver-mas')}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="col-md-7 mx-auto text-center">
                <div class="text-blue font-weight-bold ls2">{{__('Home.slogan-mejor-manera')}}</div>
                <h2 class="font-weight-bold fsize-md">{{__('Home.titulo-servicio-extra')}}</h2>
                <div class="line-sm-blue my-3 mx-auto"></div>
                <p class="text-gray fsize-sm">{{__('Home.texto-servicio-extra')}}</p>
            </div>
            <div class="col-12 col-md-10 row mx-auto">
                <div class="col-12 col-md-4">
                    <div class="card-viajes-ciudad mx-auto mt-5">
                    </div>
                    <div class="mx-auto text-center justify-content-center row card-on">
                        <span class="text-white font-weight-bold">{{__('Home.extra-cuadro-uno')}}</span>
                        <br>
                        <div class="icon-orange">
                            <img src="/img/assets/vans-cancun.webp" class="invert-white" alt="icono van">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card-rutas-tour mx-auto mt-5">
                    </div>
                    <div class="mx-auto text-center justify-content-center row card-on">
                        <span class="text-white font-weight-bold">{{__('Home.extra-cuadro-dos')}}</span>
                        <br>
                        <div class="icon-orange">
                            <img src="/img/assets/vans-cancun.webp" class="invert-white" alt="icono van">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card-service-group mx-auto mt-5">
                    </div>
                    <div class="mx-auto text-center justify-content-center row card-on">
                        <span class="text-white font-weight-bold">{{__('Home.extra-cuadro-tres')}}</span>
                        <br>
                        <div class="icon-orange">
                            <img src="/img/assets/vans-cancun.webp" class="invert-white" alt="icono van">
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="bg-testimonials">
            <div class="bg-blue py-5">
                <div class="row px-5 m-0">
                    <div class="col-12 col-md-4 mt-3">
                        <div class="d-flex align-center" style="height:100%;">
                            <div>
                                <div class="ls2 text-orange font-weight-bold">{{__('Home.testimonial-slogan')}}</div>
                                <h2 class="text-white font-weight-bold fsize-md">{{__('Home.testimonial-title')}}</h2>
                                <div class="line-sm-orange my-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 text-center mt-3">
                        <div class="card-white">
                            <img src="" alt="">
                            <div class="d-flex justify-content-center my-4">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                            </div>
                            <p class="text-gray fsize-sm mb-4">“Super puntuales, super atentos, no tienes que preocuparte de nada. Te atienden de maravilla desde que estás separando, el proceso de pago sin inconvenientes, platica amena, los encuentras fácil en el aeropuerto.”</p>
                            <p class="font-weight-bold fsize-sm">Rodrigo de la Cruz</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 text-center mt-3">
                        <div class="card-white">
                            <img src="" alt="">
                            <div class="d-flex justify-content-center my-4">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                            </div>
                            <p class="text-gray fsize-sm mb-4">“Empresa seria y responsable. Los choferes fueron muy amables y maravillosos con nosotros en nuestro viaje a Playa del carmen. Muchas gracias! Repetiremos!”</p>
                            <p class="font-weight-bold fsize-sm">Ricardo Horacio Valverde</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="text-center">
            <h2 class="fontw-weight-bold fsize-md">{{__('Home.preguntas-frecuentes')}}</h2>
            <div class="line-md-orange mb-3 mx-auto"></div>
        </div>
        <div class="container row mx-auto mt-5">
            <div class="col-12 col-md-6">
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="0" onclick="showFaq(this)" type="button">
                        <i class="fa fa-minus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-uno')}}</span>
                    </button>
                    <div class="acord-faq" data-display="1">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-uno')}}</p>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="1" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-dos')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-dos')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="2" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-tres')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-tres')}}</p>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="3" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-cuatro')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-cuatro')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">        
        $('#motorbusqueda').load('/motorbusqueda');

        let acordFaq = document.querySelectorAll('.acord-faq'),
        iconFaq = document.querySelectorAll('.icon-faq')

        function showFaq(event)
        {    
            var id = event.dataset.value        
            if(acordFaq[id].dataset.display == 0) {
                acordFaq[id].classList.remove('d-none')
                acordFaq[id].dataset.display = 1
                iconFaq[id].classList.remove('fa-plus')
                iconFaq[id].classList.add('fa-minus')
            } else {
                acordFaq[id].classList.add('d-none')
                acordFaq[id].dataset.display = 0
                iconFaq[id].classList.add('fa-plus')
                iconFaq[id].classList.remove('fa-minus')
            }
        }
    </script>
@endpush