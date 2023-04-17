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
<div class="layer-about back-slider-detail-trip"></div>
    <div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:370px;">
        <h1 class="font-weight-bold text-white fsize-xl">{{__('MotorBusqueda.detalle-viaje-personalizado')}}</h1>    
    </div>
<div>
<div class="section">
    <div class="row m-0 px-4">
        <div class="col-12 col-md-7">
            <form id="formBooking" class="container" method="POST" action="{{url($prefijo.__('Home.gracias-url'))}}">
                {{@csrf_field()}}
                <p class="font-weight-bold">Enter your data in the following fields. Please verify the entered information is correct. This information will helps us give you the best service in your arrival or in case there is a change and we need to notify. Thanks for choosing us!</p>
                <div class="my-3 box-shadow-info">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.datos-personales')}}</h3>
                    <input type="hidden" name="typetransfer" id="typetransfer" value="{{$typetransfer}}">
                    <input type="hidden" name="origin" id="origin" value="{{$origin}}">
                    <input type="hidden" name="destination" id="destination" value="{{$destination}}">
                    <input type="hidden" name="pax" id="pax" value="{{$pax}}">
                    <input type="hidden" name="urlWeb" id="urlWeb">
                    <div class="form-group mb-3">
                        <label for="fullName" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.nombre-completo')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control" id="fullName" name="fullName" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.email')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" />
                    </div>
                    <div class="form-group">
                        <label for="phone" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.telefono')}} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" />
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
                    <div class="g-recaptcha" data-sitekey="6LdCmI0lAAAAAMkIr0M4gm2aOhkngFTQ5CJhTRgI"></div>
                    <div class="col-12 col-md-12 d-grid mt-5">
                        <button id="btnBooking" class="btn btn-naranja btn-lg" type="submit">{{__('MotorBusqueda.boton-confirmar')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-5">
            <div class="box-shadow-info">
                <div class="d-flex mb-4">
                    <img src="/img/assets/bus-card.png" alt="Bus" width="80%" class="mx-auto">
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
            </div>    
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>
</script>
    <script type="text/javascript">
        
        const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
        let formcustom = document.getElementById('formcustom'),
        urlWeb = window.location.origin

        $('#urlWeb').val(urlWeb)

        $('#btnBooking').click(function(){
            SendReservation()
        })

        @if(session('messageError'))
                
            console.log({{session('messageError')}}) 
                
        @endif

        let formBooking = document.getElementById('formBooking')

        formBooking.addEventListener('submit', e => {
            e.preventDefault()

            var email=$('#email').val()
            var fullName=$('#fullName').val()
            var phone=$('#phone').val()
            var recaptcha=$('#g-recaptcha-response').val()
            var dateDeparture=$('#dateDeparture').val()
            var hourDeparture=$('#hourDeparture').val()

            if(!regex.test(email))
            {
                notification('error','{{__('Motorbusqueda.email-error')}}')
                return false;
            }
            if(fullName == '' || phone == "" || dateDeparture == '' || hourDeparture == '')
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