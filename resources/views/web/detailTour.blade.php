<?php
    use App\Models\Tour;
    use App\Models\Respuesta;
    use App\Models\VehicleTour;

    $lang = App::getLocale();
    $resp = new Respuesta;
    $tour = new Tour;
    $resp = $tour->GetTourById($idSelected);
    $vehicletour = new VehicleTour;
    $listPrecios = $vehicletour->GetPrices($idSelected);
    $countImg = 0;
    $countCheck = 0;

    $prefijo = "/";

    if($lang == 'en')
    {
        $prefijo = '/en/';
    }
    
?>
@extends('web.layouts.layout')
@section('content')
<div class="layer-detail back-slider-detail-trip"></div>
    <div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:250px;">
        <h1 class="font-weight-bold text-white fsize-xl">{{__('Tours.detalle-tour')}}</h1>    
    </div>
<div>
<div class="section">
    <div class="row m-0 px-4">
        <div class="col-12 col-md-7">
            <form id="formBooking" class="container">
                <p class="font-weight-bold text-justify">{{__('MotorBusqueda.texto-formulario')}}</p>
                <div class="my-3 box-shadow-info step">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.datos-personales')}}</h3>                    
                    <input type="hidden" name="urlWeb" id="urlWeb">
                    <input type="hidden" name="payMethod" id="payMethod" value="efectivo">       
                    <input type="hidden" name="typetransfer" id="typetransfer" value="tour">             
                    <input type="hidden" name="totalAmount" id="totalAmount">
                    <input type="hidden" name="idTour" id="idTour" value="{{$idSelected}}">
                    <input type="hidden" name="idVehicle" id="idVehicle">
                    <input type="hidden" name="orderId" id="orderId">
                    <input type="hidden" id="sillaBebe" value="0">
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
                        <input type="text" class="form-control" id="email" name="email" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.telefono')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="tel" class="form-control required" id="phone" name="phone" data-intl-tel-input-id/>
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
                    <div class="d-flex justify-content-end">                        
                        <button type="button" class="btn btn-orange btn-lg" onclick="NextStep()">{{__('MotorBusqueda.siguiente')}}</button>                        
                    </div>
                </div>
                <div class="my-3 box-shadow-info step d-none">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.salida')}}</h3>
                    <div class="form-group mb-3">
                        <label for="dateDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.fecha-salida')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="date" class="form-control required" id="dateDeparture" name="dateDeparture" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="hourDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.hora')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="time" class="form-control required" id="hourDeparture" name="hourDeparture" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="comments" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.comentarios')}}</label>
                        <textarea class="form-control" name="comments" id="comments" cols="30" rows="10" style="height:100px;"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sky btn-lg" type="button" onclick="PreviewStep()">{{__('MotorBusqueda.anterior')}}</button>
                        <button type="button" class="btn btn-orange btn-lg" onclick="NextStep()">{{__('MotorBusqueda.siguiente')}}</button>
                    </div>
                </div>
                <div class="my-3 box-shadow-info step d-none">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.metodo-pago')}}</h3>                    
                    <div class="row">
                        <div class="col-md-6" style="display:flex; align-items:center;">
                            <input type="radio" name="payment_type" id="methodcash" value="efectivo" checked>
                            <label for="methodcash"><img src="/img/icons/cash.png" style="width:200px;" alt="Cash"></label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="payment_type" id="methodConekta" value="card">
                            <label for="methodConekta"><img src="/img/icons/conekta-visa.webp" style="width:200px;" alt="Conekta"></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 d-grid mt-5 mb-3">
                        <!-- TEST -->
                        <!-- <div class="g-recaptcha mb-3" data-sitekey="6LdCmI0lAAAAAMkIr0M4gm2aOhkngFTQ5CJhTRgI"></div> -->
                        <div class="g-recaptcha mb-3" data-sitekey="6Le3mAEmAAAAALvwUCA4AT3LBsANxgWQuESx3Z8-"></div>
                        <button id="btnBooking" onclick="SendBookingCash()" class="btn btn-naranja btn-lg" type="button">{{__('MotorBusqueda.boton-confirmar')}}</button>
                        <button id="btnConekta" class="btn btn-lg btn-conekta d-none">{{__('MotorBusqueda.boton-conekta')}}</button>
                        <!-- <div id="paypal-button-container" class="d-none"></div> -->
                    </div>
                    <div class="">
                        <button class="btn btn-sky btn-lg" type="button" onclick="PreviewStep()">{{__('MotorBusqueda.anterior')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-5 mt-5">
            <div class="box-shadow-info">
                <div class="d-flex">
                    @foreach($listPrecios as $precios)
                        <img src="{{$precios['image']}}" alt="Bus" width="100%" class="mx-auto img-shuttle img-shuttle-{{$precios['vehicle_id']}} {{$countImg>0?'d-none':''}}">                        
                        @php $countImg = $countImg + 1; @endphp
                    @endforeach
                </div>
                <h3 class="font-weight-bold fsize-mds text-blue text-center mb-3">{{__('MotorBusqueda.detalle-viaje')}}</h3>                 
                <div class="d-flex justify-content-center mb-3">                    
                    <div class="d-flex align-center">
                        <div class="wrapper">
                            @foreach($listPrecios as $precios)
                                <label for="option-{{$precios['vehicle_id']}}" class="option {{$countCheck > 0 ? 'option-vehicle' : 'option-vehicle-cheked'}}">                                    
                                    <input type="radio" name="select-shuttle" id="option-{{$precios['vehicle_id']}}" data-idvehicle="{{$precios['vehicle_id']}}" data-price="{{$precios['price']}}" onchange="selectShuttle(this,event)" class="inputCheckVehicle" {{$countCheck > 0 ? '' : 'checked'}}>
                                    <div class="dot"></div>
                                    <span>{{$precios['name']}} <br> <span class="fsize-xs">{{$precios['min_pax']}} - {{$precios['max_pax']}} pax</span> </span>
                                </label>
                                @php $countCheck = $countCheck + 1; @endphp
                            @endforeach                        
                        </div>
                    </div>
                </div>
                <div>
                    @if($resp->Error == false)
                        <p><span class="font-weight-bold text-gray">Tour:</span> <span class="font-weight-bold">{{$resp->data['name']}}</span></p>
                        <p><span class="font-weight-bold text-gray">{{__('Tours.descripcion')}}:</span> <span class="font-weight-bold">{{$resp->data['descripcion_'.$lang]}}</span></p>
                    @else
                        <span>Se produjo un error</span>
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
                    <p><span class="font-weight-bold text-blue fsize-mds">Total:</span> <span class="font-weight-bold text-orange fsize-mds"><span id="total"></span> MXN</span> </p>
                </div>
                
            </div>    
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&components=buttons,funding-eligibility&currency=MXN" data-namespace="paypal_sdk"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
    <script type="text/javascript"> 
    

    function ejecutarFetch() {
        fetch('/pruebapost', {
            method: 'POST',
            headers: headConexion
        })
        .then(resp => resp.json())
        .then(resp => {
            console.log(resp)
        })
    }
                    
        //  actualiza boton menu para el home
        document.getElementById('btbMenuBook').setAttribute('href', '/')

        var inputPhone = document.getElementById("phone");
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

        let totalPagar = 0;
        var btnBooking = document.getElementById('btnBooking')
        var formBooking = document.getElementById('formBooking')
        var btnConekta = document.getElementById('btnConekta')
        // var paypalButtonContainer = document.getElementById('paypal-button-container')
        var methodcash = document.getElementById('methodcash')
        var methodConekta = document.getElementById('methodConekta')
        var step = document.querySelectorAll('.step')
        var payMethod = document.getElementById('payMethod')
        var gRecaptcha = document.querySelector('.g-recaptcha')
        var inputOrderId = document.getElementById('orderId')
        var idVehicle = document.getElementById('idVehicle')
        var totalAmount = document.getElementById('totalAmount')
        var countStep = 0
        var urlWeb = window.location.origin
        var switchShuttle = document.getElementById('switch-label')
        var dateDeparture = document.getElementById('dateDeparture')    
        var sillabebe = document.getElementById('sillaBebe')    

        $('#urlWeb').val(urlWeb)                
        var fulldate = new Date();
        fulldate.setDate(fulldate.getDate() + 2)        
        var day = fulldate.getDate();
        var month = fulldate.getMonth() + 1
        var year = fulldate.getFullYear()


        if(day < 10)
            day = '0'+day
            
        if(month < 10)
        {
            month = '0'+month
        }

        var minDay = year+'-'+month+'-'+day

        dateDeparture.setAttribute('min', minDay)
        
        function changeChairbaby(event)
        {
            sillabebe.value = event.target.value
        }

        function comprobarFecha(fecha)
        {
            return Date.parse(fecha) < Date.parse(minDay)
        }

        methodcash.addEventListener('change', e => {
            e.preventDefault()

            if(methodcash.checked)
            {
                blockschecks(false)
                btnBooking.classList.remove('d-none')
                btnConekta.classList.add('d-none')
                payMethod.value = 'efectivo'
                gRecaptcha.classList.remove('d-none')
            }
        })

        methodConekta.addEventListener('change', e => {
            e.preventDefault()

            if(methodConekta.checked)
            {
                
                blockschecks(true)
                btnBooking.classList.add('d-none')
                btnConekta.classList.remove('d-none')
                payMethod.value = 'card'
                gRecaptcha.classList.add('d-none')
            }
        })

        function blockschecks(option)
        {
            var checksblock = document.querySelectorAll('.inputCheckVehicle')

            for(let i = 0; i < checksblock.length; i++)
            {
                if(option == true)
                    checksblock[i].setAttribute('disabled', true)
                else
                    checksblock[i].removeAttribute('disabled')
            }
        }

        function NextStep()
        {
            if(countStep == 0)
            {
                if(!regex.test(document.getElementById('email').value))
                {
                    notification('error','{{__('MotorBusqueda.email-error')}}')
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
                if(comprobarFecha(dateDeparture.value))
                {
                    notification('error', '{{__('MotorBusqueda.input-requerido-date-departure')}}')
                    return false
                }
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
        function PreviewStep() {
            step[countStep].classList.add('d-none')
            step[countStep - 1].classList.remove('d-none')
            countStep--
        }

        function ValidInput(position) {
            var inputs = step[position].querySelectorAll('.required')
            
            for(i = 0; i < inputs.length; i++)
            {
                if(inputs[i].value == '')
                    return false
            }
            return true
        }

        function selectShuttle(obj,event) {
            var parent = event.target.parentNode;
            var checkCurrent = document.querySelector('.option-vehicle-cheked')
            var imgShuttle = document.querySelectorAll('.img-shuttle')

            checkCurrent.classList.add('option-vehicle')
            checkCurrent.classList.remove('option-vehicle-cheked')

            parent.classList.remove('option-vehicle')
            parent.classList.add('option-vehicle-cheked')

            for(let i = 0; i < imgShuttle.length; i++)
            {
                imgShuttle[i].classList.add('d-none')
            }
            document.querySelector('.img-shuttle-'+obj.getAttribute('data-idvehicle')).classList.remove('d-none')


            assingnementPrice()
        }

        function assingnementPrice()
        {
            var shuttle = document.querySelectorAll('.inputCheckVehicle')
            for(let i = 0; i < shuttle.length; i++)
            {
                if(shuttle[i].checked == true)
                {
                    var total = document.getElementById('total')
                    totalPagar = shuttle[i].getAttribute('data-price')
                    totalAmount.value = totalPagar
                    idVehicle.value = shuttle[i].getAttribute('data-idvehicle')
                    var precio = convertCurrency(shuttle[i].getAttribute('data-price'))
                    total.innerText = precio
                }
            }
        }
        assingnementPrice()

        @if(session('messageError'))
                
            console.log({{session('messageError')}}) 
                
        @endif

        function SendBookingCash(){
            var recaptcha = $('#g-recaptcha-response').val()

            if(recaptcha == '')
            {
                notification('error', '{{__('MotorBusqueda.recaptcha-requerido')}}')
                return false;
            }

            btnBooking.setAttribute('disabled', true)

            activeLoader('{{__('MotorBusqueda.registrando')}}...', '{{__('MotorBusqueda.enviando-correo')}}')

            formBooking.submit()
        }

        btnConekta.addEventListener('click', e => {
            e.preventDefault();
            btnConekta.setAttribute('disabled', true)
            MakePayConekta();
        });

        function MakePayConekta() {
            var formData = new FormData(formBooking);
            var objCustomer = {
                "firstName": $('#firstName').val(),
                "lastName": $('#lastName').val(),
                "email": $('#email').val(),
                "totalAmount": $('#totalAmount').val(),
                "idTour": $('#idTour').val(),
                "urlWeb": $('#urlWeb').val(),
                "payMethod": $('#payMethod').val(),
                "typetransfer": $('#typetransfer').val(),
                "idVehicle": $('#idVehicle').val(),
                "sillaBebe": $('#sillaBebe').val(),
                "phone": $('#phone').val(),
                "dateDeparture": $('#dateDeparture').val(),
                "hourDeparture": $('#hourDeparture').val(),
                "comments": $('#comments').val()
            };
            console.log(objCustomer)
            
            activeLoader(`{{__('Message.cargando')}}`, `{{__('Message.generar-link')}}`)

            fetch('/conekta-tour', {
                method: 'POST',
                headers: headConexion,
                body: JSON.stringify(objCustomer)
            })
            .then(resp => resp.json())
            .then(result => {
                console.log(result)
                if(!result.error) {
                    window.location.href = result.data.checkout.url;
                }
            })
        }

        /**
         *  DEPRECIADO
         */
        //  FUNCIONES PARA PAYPAL

        // window.paypal_sdk.Buttons({
        //     fundingSource: window.paypal_sdk.FUNDING.CARD,
        //     createOrder: function(data, actions) {
        //         return actions.order.create({
        //             application_context:{
        //                 shipping_preference: "NO_SHIPPING"
        //             },
        //             payer:{
        //                 email_address: $('#email').val(),
        //                 name: {
        //                     given_name: $('#firstName').val(),
        //                     surname: $('#lastName').val(),
        //                     phone: $('#phoneClient').val()
        //                 },
        //                 address: {
        //                     country_code: "MX"
        //                 }
        //             },
        //             purchase_units: [{
        //                 amount: {
        //                     "currency_code": "MXN",
        //                     "value": totalPagar
        //                 }
        //             }],
        //         });
        //     },
        //     onApprove: function(data, actions) {
        //         console.log(data)
        //         console.log(actions)
        //         activeLoader('{{__('MotorBusqueda.registrando')}}', '{{__('MotorBusqueda.enviando-correo')}}')
        //         var orderId = data.orderID
        //         inputOrderId.value = orderId

        //         return $.ajax({
        //             url: '/checkout/api/paypal/order',
        //             method: 'POST',
        //             data: {
        //                 _token: "{{ csrf_token() }}",
        //                 orderId: orderId
        //             },
        //             success:function(data){
                        
        //                 console.log(data)
        //                 if(data.error == false)
        //                 {
                            
        //                     console.log(data.data.status) 
        //                     if(data.data.status == 'APPROVED')
        //                     {
        //                         formBooking.submit()                                
        //                     }
        //                     else
        //                         errorAlert("Error", '{{__('MotorBusqueda.ocurrio-error')}}')
        //                 }
        //                 else
        //                     errorAlert("Error", '{{__('MotorBusqueda.ocurrio-error')}}')      
        //             }
        //         })
        //     },
        //     onError: function(error){
        //         console.log(error)
        //     }
        // }).render('#paypal-button-container');
        
    </script>
@endpush