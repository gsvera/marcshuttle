@extends('web.layouts.layout')

@section('metas')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{{__('Meta.bacalar-title')}}">
    <meta name="description" content="{{__('Meta.bacalar-descripcion')}}">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="safe for kids">
    <meta name="language" content="Spanish">
@endsection

@section('headers')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
            "@type": "Question",
            "name": "{{__('Bacalar.scritp-faq-question-uno')}}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{__('Bacalar.script-faq-answer-uno')}}"
            }
            },
            {
            "@type": "Question",
            "name": "{{__('Bacalar.script-faq-question-dos')}}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{__('Bacalar.script-faq-answer-dos')}}"
            }
            },
            {
            "@type": "Question",
            "name": "{{__('Bacalar.scritp-faq-question-tres')}}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{__('Bacalar.scritp-faq-answer-tres')}}"
            }
            },
            {
            "@type": "Question",
            "name": "{{__('Bacalar.script-faq-question-cuatro')}}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{__('Bacalar.script-faq-answer-cuatro')}}"
            }
            },
            {
            "@type": "Question",
            "name": "{{__('Bacalar.scritp-faq-question-cinco')}}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{__('Bacalar.script-faq-answer-cinco')}}"
            }
            },
            {
            "@type": "Question",
            "name": "{{__('Bacalar.scritp-faq-question-seis')}}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{__('Bacalar.script-faq-answer-seis')}}"
            }
            }
        ]
    }
</script>
@endsection

@section('content')
    <div class="layer-home back-slider-bacalar"></div>
    <div class="row mt-4 elementup m-0">
        <div class="col-12 col-md-6 row div-principal" >
            <div>
                <p class="text-cian ls2">{{__('Playa.span-titulo')}}</p>
                <h1 class="font-weight-bold text-white fsize-xl">{{__('Bacalar.titulo')}}</h1>
                <p class="font-weight-bold text-white">{{__('Bacalar.text-banner')}}</p>
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
                <P class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.reserva-rapida')}}</P>
                <p class="text-gray">{{__('Home.reserva-rapida-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white row">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/verified_user.png" alt="virified user"></span>
                </div>
                <P class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.transporte-privado')}}</P>
                <p class="text-gray">{{__('Home.transporte-privato-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/book-confirm.png" alt="currency exchange"></span>
                </div>
                <P class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.rastreo-vuelo')}}</P>
                <p class="text-gray">{{__('Home.rastreo-vuelo-text')}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 my-2">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/currency_exchange.png" alt="currency exchange"></span>
                </div>
                <P class="font-weight-bold" style="font-size: 1.125rem">{{__('Home.mejor-precio')}}</P>
                <p class="text-gray">{{__('Home.mejor-precio-text')}}</p>
            </div>
        </div>
    </div>
    <div>
        <div class="text-center" style="padding:50px 50px">
            <div class="ls2 font-weight-bold">{{__('Bacalar.autobus-slogan')}}</div>
            <h2 class="font-weight-bold fsize-md">{{__('Home.autobus-titulo')}}</h2>
            <div class="line-sm-blue my-3 mx-auto"></div>
            <div class="col-12 col-md-7 mx-auto">
                <p class="fsize-sm">{{__('Home.autobus-texto-uno')}}</p>
            </div>
        </div>
        <div class="mb-5">
            <div class="row col-12 col-md-12 mt-5 mx-0 justify-content-center">
                <div class="col-12 col-md-3 p-2">
                    <div class="card-bus-blue text-center pt-3">
                        <h3 class="font-weight-bold text-white text-center">Toyota</h3>                                
                        <ul class="without-list text-left pl-4">
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('Home.toyota-detalle')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.aa')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.agua-pasajero')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.cargadores-usb')}}
                            </li>
                        </ul>
                        <img src="/img/assets/Toyota.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:80%;">
                    </div>
                </div>
                <div class="col-12 col-md-3 p-2">
                    <div class="card-bus-blue text-center pt-3">
                        <h3 class="font-weight-bold text-white text-center">Transporter</h3>                                
                        <ul class="without-list text-left pl-4">
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('Home.transporter-detalle')}}   
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.aa')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.agua-pasajero')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.cargadores-usb')}}
                            </li>
                        </ul>
                        <img src="/img/assets/Transporter.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:80%;">
                    </div>
                </div>
                <div class="col-12 col-md-3 p-2">
                    <div class="card-bus-blue text-center pt-3">
                        <h3 class="font-weight-bold text-white text-center">Sprinter</h3>                                
                        <ul class="without-list text-left pl-4">
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('Home.sprinter-detalle')}}   
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.aa')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.agua-pasajero')}}
                            </li>
                            <li class="text-white font-weight-bold">
                                <i class="fa fa-star text-yellow fsize-15" aria-hidden="true"></i> {{__('MotorBusqueda.cargadores-usb')}}
                            </li>
                        </ul>
                        <img src="/img/assets/Sprinter.webp" alt="{{__('Home.autobus')}}" class="mx-auto" style="width:80%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="col-12 col-md-8 text-center mx-auto">
            <div class="text-blue ls2 font-weight-bold">{{__('Bacalar.translados-slogan')}}</div>
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
    <div class="section">
        <div class="text-center">
            <h2 class="fontw-weight-bold fsize-md">{{__('Home.preguntas-frecuentes')}}</h2>
            <div class="line-md-orange mb-3 mx-auto"></div>
        </div>
        <div class="container row mx-auto mt-5">
            <div class="col-12 col-md-6">
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="0" onclick="showFaq(this)" type="button">
                        <i class="fa fa-minus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Bacalar.faq-uno')}}</span>
                    </button>
                    <div class="acord-faq" data-display="1">
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-uno')}}</p>
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-uno-dos')}}</p>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="1" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Bacalar.faq-dos')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-dos')}}</p>
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-dos-dos')}}</p>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="2" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Bacalar.faq-tres')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-tres')}}</p>
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-tres-dos')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="3" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Bacalar.faq-cuatro')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-cuatro')}}</p>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn-faqs accordion-button d-flex align-items-baseline" data-value="4" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Bacalar.faq-cinco')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-cinco')}}</p>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn-faqs accordion-button" data-value="5" onclick="showFaq(this)" type="button">
                        <i class="fa fa-plus text-orange fa-2x icon-faq" aria-hidden="true"></i> <span class="fsize-mds font-weight-bold">{{__('Bacalar.faq-seis')}}</span>
                    </button>
                    <div class="acord-faq d-none" data-display="0">
                        <p class="text-justify text-gray">{{__('Bacalar.faq-resp-seis')}}</p>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <div class="section">
        <div class="banner-driver">
            <div class="">
                <div class="col-12 col-md-6 row"  style="padding:5% 0 5% 5%;">
                    <div class="text-blue ls2 font-weight-bold">{{__('Home.titulo-servicio-usted')}}</div>
                    <h2 class="font-weight-bold fsize-md">{{__('Bacalar.titulo-marc-translados')}}</h2>
                    <div class="line-sm-blue my-2" style="margin-left: calc(var(--bs-gutter-x) * 0.5);"></div>                    
                    <p class="text-gray fsize-sm mb-3">{{__('Playa.texto-marc-uno')}}</p>
                    <p class="text-gray fsize-sm">{{__('Home.texto-marc-dos')}}</p>                
                </div>
            </div>
            <div>
                <img class="img-driver-mobile" src="/img/banners/driver.jpg" alt="Driver">
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
                            <h3 class="font-weight-bold fsize-sm">Playa del carmen</h3>
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
            </div>
        </div>
    </div>
    <div class="section">
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