@php
    $lang = App::getLocale();
    $prefijo = "/";

    if($lang == 'en')
    {
        $prefijo = '/en/';
    }
    
@endphp
@extends('web.layouts.layout')
@section('content')
<div class="layer-detail back-slider-detail-trip"></div>
    <div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:250px;">
        <h1 class="font-weight-bold text-white fsize-xl">{{__('MotorBusqueda.detalle-viaje-personalizado')}}</h1>    
    </div>
<div>
<div class="section">
    <div class="row m-0 px-4">
        <div class="col-12 col-md-7">
            <form id="formBooking" class="container" method="POST" action="{{url($prefijo.__('Home.gracias-url'))}}">
                {{@csrf_field()}}
                <p class="font-weight-bold text-justify">{{__('MotorBusqueda.texto-formulario')}}</p>
                <div class="my-3 box-shadow-info">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.datos-personales')}}</h3>
                    <input type="hidden" name="typetransfer" id="typetransfer" value="{{$typetransfer}}">
                    <input type="hidden" name="origin" id="origin" value="{{$origin}}">
                    <input type="hidden" name="destination" id="destination" value="{{$destination}}">
                    <input type="hidden" name="pax" id="pax" value="{{$pax}}">
                    <input type="hidden" name="urlWeb" id="urlWeb">
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
                        <input type="tel" class="form-control" id="phone" name="phone" />
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
                        <label for="dateDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.fecha-salida')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="date" class="form-control" id="dateDeparture" name="dateDeparture" value="{{$dateDeparture}}" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="hourDeparture" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.hora')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="time" class="form-control" id="hourDeparture" name="hourDeparture" />
                    </div>
                    <div class="form-group">
                        <label for="comments" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.comentarios')}}</label>
                        <textarea class="form-control" name="comments" id="comments" cols="30" rows="10" style="height:100px;"></textarea>
                    </div>
                </div>
                <div class="my-3 box-shadow-info">
                        <!-- TEST -->
                        <!-- <div class="g-recaptcha mb-3" data-sitekey="6LdCmI0lAAAAAMkIr0M4gm2aOhkngFTQ5CJhTRgI"></div> -->
                        <div class="g-recaptcha mb-3" data-sitekey="6Le3mAEmAAAAALvwUCA4AT3LBsANxgWQuESx3Z8-"></div>
                    <div class="col-12 col-md-12 d-grid mt-5">
                        <button id="btnBooking" class="btn btn-naranja btn-lg" type="submit">{{__('MotorBusqueda.boton-confirmar')}}</button>
                    </div>
                </div>
            </form>
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
                    <span class="font-weight-bold text-gray">{{__('MotorBusqueda.type-transfer')}}:</span> <span class="font-weight-bold">{{__('MotorBusqueda.viaje-personalizado')}}</span>
                </p>
                <p><span class="font-weight-bold text-gray">{{__('MotorBusqueda.origen')}}:</span> <span class="font-weight-bold">{{$origin}}</span></p>
                <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.destino')}}:</span> <span class="font-weight-bold">{{$destination}}</span></P>
                <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.pasajeros')}}:</span> <span class="font-weight-bold">{{$pax}}</span></P>
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
            </div>    
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>
</script>
    <script type="text/javascript">

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
                
        let formcustom = document.getElementById('formcustom'),
        urlWeb = window.location.origin
        var dateDeparture = document.getElementById('dateDeparture')
        var sillabebe = document.getElementById('sillaBebe')    

        $('#urlWeb').val(urlWeb)                
        var fulldate = new Date();
        fulldate.setDate(fulldate.getDate() + 1)
        var day = fulldate.getDate();
        var month = fulldate.getMonth() + 1
        var year = fulldate.getFullYear()


        if(day < 10)
            day = '0'+day
        
        if(month < 10)
        {
            month = '0'+month
        }
        dateDeparture.setAttribute('min', year+'-'+month+'-'+day)        

        $('#btnBooking').click(function(){
            SendReservation()
        })

        function changeChairbaby(event)
        {
            sillabebe.value = event.target.value
        }

        @if(session('messageError'))
                
            console.log({{session('messageError')}}) 
                
        @endif

        let formBooking = document.getElementById('formBooking')

        formBooking.addEventListener('submit', e => {
            e.preventDefault()

            var email=$('#email').val()
            var firstName=$('#firstName').val()
            var lastName=$('#lastName').val()
            var phone=$('#phone').val()
            var recaptcha=$('#g-recaptcha-response').val()
            var dateDeparture=$('#dateDeparture').val()
            var hourDeparture=$('#hourDeparture').val()

            if(!regex.test(email))
            {
                notification('error','{{__('Motorbusqueda.email-error')}}')
                return false;
            }
            if(iti.isValidNumber() == false)
            {
                notification('error', '{{__('MotorBusqueda.telefono-valido')}}')
                return false;
            }
            
            if(firstName == '' || lastName == '' || phone == "" || dateDeparture == '' || hourDeparture == '')
            {
                notification('error', '{{__('Motorbusqueda.campos-obligatorios')}}')
                return false;
            }
            if(recaptcha == '')
            {
                notification('error', '{{__('MotorBusqueda.recaptcha-requerido')}}')
                return false;
            }       

            document.getElementById('btnBooking').setAttribute('disabled', true)

            activeLoader('cargando...', "enviando correo")

            formBooking.submit()

        })

        
    </script>
@endpush