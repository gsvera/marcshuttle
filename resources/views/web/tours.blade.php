<?php
    use App\Models\Respuesta;
    use App\Models\Tour;
    use App\Models\Utils;

    $lang = App::getLocale();
    $resp = new Respuesta();
    $listTour = new Tour;
    $resp = $listTour->GetTours();
    $prefijo = "";

    if($lang == 'en')
    {
        $prefijo = '/en/';
    }
    else{
        $prefijo = '/';
    }
?>

@extends('web.layouts.layout')

@section('metas')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{{__('Meta.tours-title')}}">
    <meta name="description" content="{{__('Meta.tours-descripcion')}}">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="safe for kids">
    <meta name="language" content="Spanish">
@endsection

@section('content')
    <div class="layer-tours back-slider-tours">
    </div>
    <div class="row elementup mg-title-tour">
        <h1 class="fsize-xl text-white font-weight-bold ml-5">{{__('Tours.titulo')}} <br> {{__('Tours.titulo-dos')}}</h1>
    </div>
    <div class="section" id="section-tours">
        <div class="col-12 col-md-8 text-center mx-auto">
            <div class="text-blue ls2 font-weight-bold">{{__('Tours.translados-slogan')}}</div>
            <h2 class="font-weight-bold fsize-md">{{__('Tours.subtitulo-tour')}}</h2>
            <div class="line-sm-blue my-3 mx-auto"></div>
            <p class="text-gray fsize-sm">{{__('Tours.texto-uno')}}</p>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">

<!-- AQUI COMIENCE EL FOR PARA LOS TOURS -->
                
                    @if($resp->error == false)
                        @foreach($resp->data as $tour)
                            <div class="col-12 col-md-4 my-2">
                                <div class="card-tour">
                                    <div class="content-img-card">
                                        <img src="{{$tour['image']}}" alt="{{$tour['name']}}" style="max-width:100%;max-height:100%;border-radius:5px;">
                                    </div>
                                    <h3 class="font-weight-bold mt-2">{{$tour['name']}}</h3>
                                    <div class="d-flex">
                                        <div class="col-9 col-md-9">
                                            @if($lang == 'en')
                                                {{$tour['descripcion_en']}}
                                                <br>
                                                1 - 15 PAX or 15 - 20 PAX
                                                <br>
                                                {{'From '.Utils::asDollars($tour['price']). ' MXN' }}
                                            @else
                                                {{$tour['descripcion_es']}}
                                                <br>
                                                1 - 15 PAX hasta 15 - 20 PAX
                                                <br>
                                                {{'Desde '.Utils::asDollars($tour['price']). ' MXN' }}
                                            @endif
                                            
                                        </div>
                                        <div class="col-3 col-md-3 d-flex justify-content-center align-center">
                                            <div class="card-icono">
                                                <img src="/img/assets/vans-cancun.webp" alt="icono van" style="width:55px;filter:invert(1);">
                                            </div>
                                        </div>                        
                                    </div>
                                    <a href="{{url($prefijo.'tours/'.str_replace(' ','-',$tour['name']).'/'.$tour['id'])}}" type="button" class="btn text-orange font-weight-bold">{{__('Tours.cotizar')}}</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span>{{$resp->Message}}</span>
                    @endif
                
                

<!-- AQUI TERMINA EL FOR PARA LOS TOURS -->

            </div>

            
        </div>
    </div>
    <div class="section">
        <div class="container">
            <p class="fsize-sm text-center">{{__('Tours.texto-dos')}}</p>
            <p class="fsize-sm text-center">{{__('Tours.texto-tres')}}</p>
            <p class="fsize-sm text-center">{{__('Tours.texto-cuatro')}}</p>
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
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function(){
            if(screen.width > 640){
                $(window).scroll(function(){
                    if($(window).scrollTop() > 20){
                        $('#section-tours').addClass('margin-ext-banner')
                    }
                    else if($(window).scrollTop() < 20){
                        $('#section-tours').removeClass('margin-ext-banner')
                    }
                })
            }
            else if(screen.width < 640){
                $(window).scroll(function(){
                    if($(window).scrollTop() > 20){
                        $('#section-tours').addClass('margin-ext-banner')
                    }
                    else if($(window).scrollTop() < 20){
                        $('#section-tours').removeClass('margin-ext-banner')
                    }
                })
                $('#footer-extend').css({'display':'none'})
            }
        })

        //  actualiza boton menu para el home
        document.getElementById('btbMenuBook').setAttribute('href', '/')
    </script>
@endpush