@extends('web.layouts.layout')
@section('content')
    <div class="layer-home back-slider-home"></div>
    <div class="row mt-4 elementup m-0">
        <div class="col-12 col-md-6 row div-principal" >
            <div>
                <p class="text-cian ls2">{{__('Home.transportacion-slogan')}}</p>
                <h1 class="font-weight-bold text-white fsize-xl">{{__('Home.titulo-inicio')}}</h1>
                <p class="font-weight-bold text-white">{{__('Home.texto-principal')}}</p>
                <button class="btn btn-white-contac btn-lg font-weight-bold">{{__('Home.contactanos')}}</button>
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
                <h5 class="font-weight-bold">{{__('Home.reserva-rapida')}}</h5>
                <p class="text-gray">{{__('Home.reserva-rapida-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white row">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/verified_user.png" alt="virified user"></span>
                </div>
                <h5 class="font-weight-bold">{{__('Home.transporte-privado')}}</h5>
                <p class="text-gray">{{__('Home.transporte-privato-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/book-confirm.png" alt="currency exchange"></span>
                </div>
                <h5 class="font-weight-bold">{{__('Home.rastreo-vuelo')}}</h5>
                <p class="text-gray">{{__('Home.rastreo-vuelo-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/currency_exchange.png" alt="currency exchange"></span>
                </div>
                <h5 class="font-weight-bold">{{__('Home.mejor-precio')}}</h5>
                <p class="text-gray">{{__('Home.mejor-precio-text')}}</p>
            </div>
        </div>
        <!-- <div class="col-12 col-md-3 my-2">
            <div class="card-img">
                <div class="card-img-blue row">
                    <div>
                        <h5 class="text-white font-weight-bold mb-4" style="font-size:1.7em;">Travel now. Pay later. <br />Always interest-free.</h5>
                        <button class="btn btn-white-contac btn-lg font-weight-bold">Learn More</button>
                    </div>
                </div>
            </div>
        </div> -->
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
                    <div>
                        <button type="button" class="btn btn-naranja btn-lg px-4 py2">{{__('MotorBusqueda.aprende-mas')}}</button>
                    </div>
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
                                <h5 class="font-weight-bold text-center">MCI Bus</h5>                                
                                <ul class="without-list text-left">
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> 1 - 10 {{__('MotorBusqueda.pasajeros')}}   
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
                                <img src="/img/assets/traslados-en-cancun.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:100%;">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 p-2">
                            <div class="card-bus text-center pt-3">
                                <h5 class="font-weight-bold">MCI Bus</h5>
                                <ul class="without-list text-left">
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> 1 - 10 {{__('MotorBusqueda.pasajeros')}}   
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
                                <img src="/img/assets/traslados-en-cancun.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:100%;">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 p-2">
                            <div class="card-bus text-center pt-3">
                                <h5 class="font-weight-bold">MCI Bus</h5>
                                <ul class="without-list text-left">
                                    <li>
                                        <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> 1 - 10 {{__('MotorBusqueda.pasajeros')}}   
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
                                <img src="/img/assets/traslados-en-cancun.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:100%;">
                            </div>
                        </div>
                        <!-- <div class="col-12 col-md-3 p-2">
                            <div class="card-bus text-center pt-3">
                                <h5 class="font-weight-bold">Setra Bus</h5>
                                <div class="text-gray mb-1">39 - 57 Passengers</div>
                                <div class="d-flex justify-content-center">
                                    <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                    <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                    <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                    <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                    <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                                </div>
                                <img src="/img/assets/bus-card.png" alt="{{__('Home.autobus')}}" class="mx-auto my-5" style="width:80%;">
                            </div>
                        </div> -->
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
    <!-- <div class="mtn-2">
        <div class="col-12 col-md-10 back-footer row bor-y-r-5 m-0">
            <div class="col-12 col-md-6 p-0">
                <img src="/img/assets/bus-banner.png" alt="{{__('Home.autobus')}}" class="bus-banner">
            </div>
            <div class="col-12 col-md-6 py-5 px-4">
                <div class="ls2 text-orange font-weight-bold">PREMIUM</div>
                <h2 class="text-white font-weight-bold fsize-md">PREMIUM AMENITIES ON BOARD</h2>
                <div class="line-sm-orange my-3"></div>
                <p class="text-white fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim orci. In lectus bibendum gravida aliquet faucibus consectetur lectus imperdiet vulputate scelerisque. Tempor in aenean neque</p>
                <div class="col-md-8">
                    <div class="d-flex my-5">
                        <div class="col-md-4 text-white font-weight-bold fsize-sm">
                            Premium <br class="none-mobile"/> Class
                        </div>
                        <div class="col-md-5 d-flex align-center">
                            <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                            <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                            <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                            <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                            <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <button class="btn btn-naranja btn-lg">Request a Quote</button>
                <button class="btn btn-outline-white">
                    <i class="fa fa-phone" aria-hidden="true"></i> 001-234-5678
                </button>
            </div>
        </div> -->
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
                <!-- <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/banners/traslados-cancun.webp" alt="translados cancun" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h4 class="font-weight-bold fsize-sm">Zona Hotelera</h4>
                            <p class="text-gray font-weight-bold">{{__('Home.destination-text-uno')}}</p>
                            <span class="text-orange font-weight-bold fsize-xs">{{__('Home.ver-mas')}} <i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div> -->
                <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/assets/transporte-traslado-playa-del-carmen.webp" alt="transporte traslado playa del carmen" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h4 class="font-weight-bold fsize-sm">Playa del carme</h4>
                            <p class="text-gray font-weight-bold">{{__('Home.destination-text-dos')}}</p>
                            <a href="{{url(__('Playa.url'))}}" class="without-link text-orange font-weight-bold fsize-xs">{{__('Home.ver-mas')}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/assets/transporte-tulum.webp" alt="transporte-tulum" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h4 class="font-weight-bold fsize-sm">Tulum</h4>
                            <p class="text-gray font-weight-bold">{{__('Home.destination-text-tres')}}</p>
                            <a href="{{url(__('Tulum.url'))}}" class="without-link text-orange font-weight-bold fsize-xs">{{__('Home.ver-mas')}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card-destination">
                        <div class="over-hiden d-flex justify-content-center">
                            <img loading="lazy" src="/img/assets/transporte-traslado.webp" alt="transporte traslado" class="img-destination">
                        </div>
                        <div class="p-3">
                            <h4 class="font-weight-bold fsize-sm">Bacalar</h4>
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
                    <div class="card-black mx-auto mt-5">
                    </div>
                    <div class="mx-auto text-center justify-content-center row" style="margin-top: -50px;">
                        <span class="text-white font-weight-bold">{{__('Home.extra-cuadro-uno')}}</span>
                        <br>
                        <div class="icon-orange">
                            <img src="/img/assets/vans-cancun.webp" class="invert-white" alt="icono van">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card-black mx-auto mt-5">
                    </div>
                    <div class="mx-auto text-center justify-content-center row" style="margin-top: -50px;">
                        <span class="text-white font-weight-bold">{{__('Home.extra-cuadro-dos')}}</span>
                        <br>
                        <div class="icon-orange">
                            <img src="/img/assets/vans-cancun.webp" class="invert-white" alt="icono van">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card-black mx-auto mt-5">
                    </div>
                    <div class="mx-auto text-center justify-content-center row" style="margin-top: -50px;">
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
                            <p class="text-gray fsize-sm mb-4">“Purus porta feugiat egestas a diam sed ipsum enim orciIn lectus biben gravida aliquet faucibus consec tetur lectus imperdiet empor”</p>
                            <p class="font-weight-bold fsize-sm">Leonardo Goodman</p>
                            <span class="text-blue">Manager</span>
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
                            <p class="text-gray fsize-sm mb-4">“Purus porta feugiat egestas a diam sed ipsum enim orciIn lectus biben gravida aliquet faucibus consec tetur lectus imperdiet empor”</p>
                            <p class="font-weight-bold fsize-sm">Emilia Porter</p>
                            <span class="text-blue">Digital Marketer</span>
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
                <div>
                    <button class="btn-faqs accordion-button" data-value="0" onclick="showFaq(this)" type="button">
                        <i class="fa fa-minus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-uno')}}</span>
                    </button>
                    <div class="acord-faq" data-display="1">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-uno')}}</p>
                    </div>
                </div>
                <div>
                    <button class="btn-faqs accordion-button" data-value="1" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-dos')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-dos')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div>
                    <button class="btn-faqs accordion-button" data-value="2" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Home.faq-tres')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Home.faq-resp-tres')}}</p>
                    </div>
                </div>
                <div>
                    <button class="btn-faqs accordion-button" data-value="3" onclick="showFaq(this)" type="button">
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
            if(acordFaq[id].dataset.display == 0)
            {
                acordFaq[id].classList.remove('d-none')
                acordFaq[id].dataset.display = 1
                iconFaq[id].classList.remove('fa-plus')
                iconFaq[id].classList.add('fa-minus')
            }
            else
            {
                acordFaq[id].classList.add('d-none')
                acordFaq[id].dataset.display = 0
                iconFaq[id].classList.add('fa-plus')
                iconFaq[id].classList.remove('fa-minus')
            }
        }
    </script>
@endpush