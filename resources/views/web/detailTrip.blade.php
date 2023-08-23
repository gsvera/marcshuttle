<?php 
use App\Models\Utils;

$lang = App::getLocale();
$prefijo = "/";

if($lang == 'en')
{
    $prefijo = '/en/';
}

$total = "";
$amount = 0;
$labelTypeTransfer = __('MotorBusqueda.aeropuerto-hotel');

if($typetransfer == 2)
{
    $labelTypeTransfer = __('MotorBusqueda.hotel-aeropuerto');
}
else if($typetransfer == 3)
{
    $labelTypeTransfer = __('MotorBusqueda.redondo-aeropuerto');
}


if($pax < 8)
{
    if($typetransfer == 3)
    {
        $total = Utils::asDollars($objDestination->uno_siete * 2);
        $amount = $objDestination->uno_siete * 2;
    }
    else{
        $total = Utils::asDollars($objDestination->uno_siete);
        $amount = $objDestination->uno_siete;
    }
}
else if($pax > 7 && $pax <= 10)
{
    if($typetransfer == 3)
    {
        $total = Utils::asDollars($objDestination->ocho_diez * 2);
        $amount = $objDestination->ocho_diez * 2;
    }
    else{
        $total = Utils::asDollars($objDestination->ocho_diez);
        $amount =$objDestination->ocho_diez;
    }
}
else
{
    //     PROCESO PARA CUANDO LOS PAX SUPERAN LA CANTIDAD DE 10
    $ciclos = floor($pax / 10);
    $enteros = 0;
    $residuos = 0;
    $divisor = 0;
    
    //  OBTENEMOS LOS ENTEROS PARA SABER CUANTAS VANS COMPLETAS SON
    for($i = 1; $i < $ciclos + 1; $i++)
    {
        $divisor = $i * 10;
        if($pax >= $divisor)
        {
            $enteros = $enteros + 1;
        }
    }
    
    //  OBTENEMOS LOS RESIDUOS PARA SABER LA CANTIDAD FALTANTES PARA LAS VANS
    $residuo = $pax - $divisor;    
    
    if($typetransfer == 3)
    {
        $roundPrice = $objDestination->ocho_diez * 2;
        $amount = $roundPrice * $enteros;
    }
    else{
        $amount =$objDestination->ocho_diez * $enteros;
    }
    
    if($residuo > 0 && $residuo < 8)
    {
        if($typetransfer == 3)
        {
            $amount = $amount + ($objDestination->uno_siete * 2);
        }
        else
        {
            $amount = $amount + $objDestination->uno_siete;
        }        
    }
    else if($residuo > 0)
    {
        if($typetransfer == 3)
        {
            $amount = $amount + ($objDestination->ocho_diez * 2);
        }
        else
        {
            $amount = $amount + $objDestination->ocho_diez;
        }
    }
}

$total = Utils::asDollars($amount);

?>

@extends('web.layouts.layout')
@section('content')
<div class="layer-detail back-slider-detail-trip"></div>
    <div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:250px;">
        <h1 class="font-weight-bold text-white fsize-xl">{{__('MotorBusqueda.detalle-viaje')}}</h1>    
    </div>
<div>
<div class="section">
    <div class="row m-0 px-4">
        <div class="col-12 col-md-7">
            <div class="container" id="formBooking">                
                <p class="font-weight-bold text-justify">{{__('Motorbusqueda.texto-formulario')}}</p>
                <input type="hidden" id="typetransfer" name="typetransfer" value="{{$typetransfer}}">                
                <input type="hidden" name="pax" id="pax" value={{$pax}}>
                <input type="hidden" name="nameZone" id="nameZone" value="{{$objDestination->name}}">
                <input type="hidden" name="idZone" id="idZone" value="{{$objDestination->id}}">
                <input type="hidden" name="urlWeb" id="urlWeb">
                <input type="hidden" name="payMethod" id="payMethod" value="efectivo">
                <input type="hidden" name="amount" id="amount" value="{{$amount}}">
                <input type="hidden" id="sillaBebe" value="0">
                @if($typetransfer == 2)
                    <input type="hidden" name="origin" id="origin" value="{{$origin}}">
                @else
                    <input type="hidden" name="destination" id="destination" value="{{$destination}}">
                @endif
                <div class="my-3 box-shadow-info step">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.datos-personales')}}</h3>
                    <div class="form-group mb-3">
                        <label for="fristName" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.nombres')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control required" id="firstName" name="firstName"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastName" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.apellidos')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control required" id="lastName" name="lastName"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.email')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control required" id="email" name="email"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phoneClient" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.telefono')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="tel" class="form-control required" id="phoneClient" name="phoneClient"/>
                    </div>
                    <div class="mb-3">
                        <p class="font-weight-bold fsize-sm text-gray mb-0">{{__('MotorBusqueda.silla-bebe')}}</p>
                        <div class="d-flex">
                            <div class="d-flex align-center mx-2">
                                <label for="noSilla" class="font-weight-bold fsize-sm mx-1">No</label>
                                <input type="radio" name="sillaBebe" id="noSilla" onchange="changeChairbaby(event)" value="0" class="mycheck" checked>
                            </div>
                            <div class="d-flex align-center mx-2">
                                <label for="siSilla" class="font-weight-bold fsize-sm mx-1">{{__('MotorBusqueda.si')}}</label>
                                <input type="radio" name="sillaBebe" id="siSilla" onchange="changeChairbaby(event)" value="1" class="mycheck">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="comments" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.comentarios')}}</label>
                        <textarea class="form-control" name="comments" id="comments" cols="30" rows="10" style="height:100px;"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" class="btn btn-orange btn-lg" onclick="NextStep()">{{__('MotorBusqueda.siguiente')}}</button>                        
                    </div>
                </div>
                @if($typetransfer == 1 || $typetransfer == 3)                    
                    <div class="my-3 box-shadow-info step d-none">
                        <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.llegada')}}</h3>
                        <div class="form-group mb-3">
                            <label for="dateArrival" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.fecha-llegada')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="date" class="form-control required" id="dateArrival" name="dateArrival" value="{{$dateArrival}}" required/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="hourArrival" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.hora')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="time" class="form-control required" id="hourArrival" name="hourArrival" required/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="infoArrival" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.info-vuelo')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" class="form-control required" id="infoArrival" name="infoArrival" placeholder="{{__('MotorBusqueda.ejemplo-num-vuelo')}}" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sky btn-lg" type="button" onclick="PreviewStep()">{{__('MotorBusqueda.anterior')}}</button>
                            <button type="button" class="btn btn-orange btn-lg" onclick="NextStep()">{{__('MotorBusqueda.siguiente')}}</button>
                        </div>
                    </div>
                @endif
                @if($typetransfer == 2 || $typetransfer == 3)
                    <div class="my-3 box-shadow-info step d-none">
                        <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.salida')}}</h3>
                        <div class="form-group mb-3">
                            <label for="dateDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.fecha-salida')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="date" class="form-control required" id="dateDeparture" name="dateDeparture" value="{{$dateDeparture}}" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="hourDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.hora')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="time" class="form-control required" id="hourDeparture" name="hourDeparture" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="infoDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.info-vuelo')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" class="form-control required" id="infoDeparture" name="infoDeparture" placeholder="{{__('MotorBusqueda.ejemplo-num-vuelo')}}"/>
                        </div>    
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sky btn-lg" type="button" onclick="PreviewStep()">{{__('MotorBusqueda.anterior')}}</button>
                            <button type="button" class="btn btn-orange btn-lg" onclick="NextStep()">{{__('MotorBusqueda.siguiente')}}</button>
                        </div>                    
                    </div>
                @endif
                <div class="my-3 box-shadow-info step d-none">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.metodo-pago')}}</h3>                    
                    <div class="row">
                        <div class="col-md-6" style="display:flex; align-items:center;">
                            <input type="radio" name="payment_type" id="methodcash" value="efectivo" checked>
                            <label for="methodcash"><img src="/img/icons/cash.png" style="width:200px;" alt="Cash"></label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="payment_type" id="methodpaypal" value="card">
                            <label for="methodpaypal"><img src="/img/icons/conekta-visa.webp" style="width:200px;" alt="Conekta"></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 d-grid mt-5 mb-3">
                        <div class="g-recaptcha mb-3" data-sitekey="{{env('GOOGLE_PUBLIC_KEY')}}"></div>
                        <button id="btnBooking" onclick="SendBookingCash()" class="btn btn-naranja btn-lg" type="button">{{__('MotorBusqueda.boton-confirmar')}}</button>
                        <button id="btnConekta" class="btn btn-lg btn-conekta d-none">{{__('MotorBusqueda.boton-conekta')}}</button>
                    </div>
                    <div class="">
                        <button class="btn btn-sky btn-lg" type="button" onclick="PreviewStep()">{{__('MotorBusqueda.anterior')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="box-shadow-info">
                <div class="d-flex">
                    <img src="/img/assets/traslados-en-cancun.webp" alt="Bus" width="100%" class="mx-auto">
                </div>
                <div class="text-center">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.detalle-viaje')}}</h3>
                    @if($pax < 8)
                        <h4 class="font-weight-bold">{{__('MotorBusqueda.uno-siete')}}</h4>
                    @elseif($pax > 7)
                        <h4 class="font-weight-bold">{{__('MotorBusqueda.ocho-diez')}}</h4>
                    @endif
                </div>
                
                <p>
                    <span class="font-weight-bold text-gray">{{__('MotorBusqueda.type-transfer')}}:</span> <span class="font-weight-bold">{{$labelTypeTransfer}}</span>
                </p>
                @if($typetransfer == 1 || $typetransfer == 3)        
                    <p><span class="font-weight-bold text-gray">{{__('MotorBusqueda.de')}}:</span> <span class="font-weight-bold">{{__('MotorBusqueda.aeropuerto')}}</span></p>
                    <p><span class="font-weight-bold text-gray">{{__('MotorBusqueda.zona')}}:</span> <span class="font-weight-bold">{{$objDestination->name}}</span></p>
                    <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.destino')}}:</span> <span class="font-weight-bold">{{$destination}}</span></P>
                    <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.pasajeros')}}:</span> <span class="font-weight-bold">{{$pax}}</span></P>
                @elseif($typetransfer == 2)
                    <p><span class="font-weight-bold text-gray">{{__('MotorBusqueda.origen')}}:</span> <span class="font-weight-bold">{{$origin}}</span></p>
                    <p><span class="font-weight-bold text-gray">{{__('MotorBusqueda.zona')}}:</span> <span class="font-weight-bold">{{$objDestination->name}}</span></p>
                    <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.a')}}:</span> <span class="font-weight-bold">{{__('MotorBusqueda.aeropuerto')}}</span></P>
                    <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.pasajeros')}}:</span> <span class="font-weight-bold">{{$pax}}</span></P>
                @endif

                <h4 class="font-weight-bold text-blue">{{__('MotorBusqueda.incluido')}}</h4>
                <ul class="without-list">
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-uno')}}
                    </li>
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-dos')}}
                    </li>
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-tres')}}
                    </li>
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-cuatro')}}
                    </li>
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-cinco')}}
                    </li>
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-seis')}}
                    </li>
                    <li>
                        <i class="fa fa-check-square-o text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.incluido-siete')}}
                    </li>
                </ul>                
                <p><span class="font-weight-bold text-blue fsize-mds">Total:</span> <span class="font-weight-bold text-orange fsize-mds">{{$total}} MXN</span> </p>
            </div>    
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script type="text/javascript">

        //  actualiza boton menu para el home
        document.getElementById('btbMenuBook').setAttribute('href', '/')

        var btnBooking = document.getElementById('btnBooking')
        
        // var paypalButtonContainer = document.getElementById('paypal-button-container')
        var btnConekta = document.getElementById('btnConekta');
        var methodcash = document.getElementById('methodcash')
        var methodpaypal = document.getElementById('methodpaypal')        
        var step = document.querySelectorAll('.step')
        var payMethod = document.getElementById('payMethod')
        var gRecaptcha = document.querySelector('.g-recaptcha')
        var inputOrderId = document.getElementById('orderId')
        var sillabebe = document.getElementById('sillaBebe')    
        var countStep = 0
        var urlWeb = window.location.origin

        var inputPhone = document.getElementById("phoneClient");
        var iti = window.intlTelInput(inputPhone, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
         initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        //preferredCountries: ['mx','do'],
        separateDialCode: true,
        utilsScript: "/js/utils.js",
        });

        iti.setCountry('MX')
        

        $('#urlWeb').val(urlWeb)                
        var fulldate = new Date();
        fulldate.setDate(fulldate.getDate() + 1)
        var day = fulldate.getDate();
        var month = fulldate.getMonth() + 1
        var year = fulldate.getFullYear()
        
        if(day < 10)
            day = '0'+day

        if(month < 10)
            month = '0'+month                

        var minDay = year+'-'+month+'-'+day

        @if($typetransfer == 1 || $typetransfer == 3)       
            var dateArrival = document.getElementById('dateArrival')
            dateArrival.setAttribute('min', minDay)
        @endif
        @if($typetransfer == 2 || $typetransfer == 3)       
            var dateDeparture = document.getElementById('dateDeparture')
            dateDeparture.setAttribute('min', minDay)
        @endif

        function comprobarFecha(fecha)
        {
            return Date.parse(fecha) < Date.parse(minDay)
        }

        function changeChairbaby(event)
        {
            sillabebe.value = event.target.value
        }
        
        
        methodcash.addEventListener('change', e => {
            e.preventDefault()

            if(methodcash.checked)
            {
                btnBooking.classList.remove('d-none')
                btnConekta.classList.add('d-none')
                payMethod.value = 'efectivo'
                gRecaptcha.classList.remove('d-none')
            }
        })

        methodpaypal.addEventListener('change', e => {
            e.preventDefault()

            if(methodpaypal.checked)
            {
                btnBooking.classList.add('d-none')
                btnConekta.classList.remove('d-none')
                payMethod.value = 'card'
                gRecaptcha.classList.add('d-none')
            }
        })

        function NextStep()
        {
            if(countStep == 0)
            {
                if(!regex.test(document.getElementById('email').value))
                {
                    notification('error','{{__('Motorbusqueda.email-error')}}')
                    return false;
                }
                if(iti.isValidNumber() == false)
                {
                    notification('error', '{{__('MotorBusqueda.telefono-valido')}}')
                    return false;
                }
            }

            if(countStep > 0)
            {
                @if($typetransfer == 1 || $typetransfer == 3)       
                    var dateArrival = document.getElementById('dateArrival')
                    if(comprobarFecha(dateArrival.value))
                    {
                        notification('error', '{{__('MotorBusqueda.input-requerido-date-arrival')}}')
                        return false
                    }
                @endif

                @if($typetransfer == 2 || $typetransfer == 3)
                    var dateDeparture = document.getElementById('dateDeparture')
                    if(comprobarFecha(dateDeparture.value))
                    {
                        notification('error', '{{__('MotorBusqueda.input-requerido-date-departure')}}')
                        return false
                    }                    
                @endif
            }
            

            if(ValidInput(countStep) == true)
            {
                step[countStep].classList.add('d-none')
                step[countStep + 1].classList.remove('d-none')
                countStep++
            }
            else{
                notification("warning", '{{__('MotorBusqueda.campos-obligatorios')}}')
            }
        }
        function PreviewStep()
        {
            step[countStep].classList.add('d-none')
            step[countStep - 1].classList.remove('d-none')
            countStep--
        }

        function ValidInput(position)
        {
            var inputs = step[position].querySelectorAll('.required')
            
            for(i = 0; i < inputs.length; i++)
            {
                if(inputs[i].value == '')
                    return false
            }
            return true
        }

        btnConekta.addEventListener('click', e => {
            e.preventDefault();
            btnConekta.setAttribute('disabled', true);
            MakePayConekta();
        });

        function makeObjReservation() {
            return {
                @if($typetransfer == 1 || $typetransfer == 3)   
                    "dateArrival": $('#dateArrival').val(),
                    "hourArrival": $('#hourArrival').val(),
                    "infoArrival": $('#infoArrival').val(),
                @endif
                @if($typetransfer == 2 || $typetransfer == 3)
                    "dateDeparture": $('#dateDeparture').val(),
                    "hourDeparture": $('#hourDeparture').val(),
                    "infoDeparture": $('#infoDeparture').val(),
                @endif
                @if($typetransfer == 1 || $typetransfer == 3)
                    "destination": $('#destination').val(),    
                @endif
                @if($typetransfer == 2)
                    "origin": $('#origin').val(),
                @endif
                "typetransfer": $('#typetransfer').val(),
                "pax": $('#pax').val(),
                "nameZone": $('#nameZone').val(),
                "idZone": $('#idZone').val(),
                "urlWeb": $('#urlWeb').val(),
                "payMethod": $('#payMethod').val(),
                "amount": $('#amount').val(),
                "sillaBebe": $('#sillaBebe').val(),
                "firstName": $('#firstName').val(),
                "lastName": $('#lastName').val(),
                "email": $('#email').val(),
                "phone": $('#phoneClient').val(),
                "comments": $('#comments').val()
            }
        }

        function MakePayConekta() {
            activeLoader(`{{__('Message.cargando')}}`, `{{__('Message.generar-link')}}`);

            fetch('/conekta-transfer', {
                method: 'POST',
                headers: headConexion,
                body: JSON.stringify(makeObjReservation())
            })
            .then(resp => resp.json())
            .then(res => {
                console.log(res)
                if(!res.error) {
                    window.location.href = res.data.checkout.url;
                }
            })
        }

        function SendBookingCash()
        {
            var recaptcha = $('#g-recaptcha-response').val()

            if(recaptcha == '')
            {
                notification('error', '{{__('MotorBusqueda.recaptcha-requerido')}}')
                return false;
            }

            btnBooking.setAttribute('disabled', true)

            activeLoader('{{__('MotorBusqueda.registrando')}}...', '{{__('MotorBusqueda.enviando-correo')}}')

            // formBooking.submit()
        }        
        
    </script>
@endpush