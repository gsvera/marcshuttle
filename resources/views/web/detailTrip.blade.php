@extends('web.layouts.layout')
@section('content')
<div class="layer-about back-slider-detail-trip"></div>
    <div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:370px;">
        <h1 class="font-weight-bold text-white fsize-xl">{{__('MotorBusqueda.detalle-viaje')}}</h1>    
    </div>
<div>
<div class="section">
    <div class="row m-0 px-4">
        <div class="col-12 col-md-6">
            <div class="container">
                <p class="font-weight-bold">Enter your data in the following fields. Please verify the entered information is correct. This information will helps us give you the best service in your arrival or in case there is a change and we need to notify. Thanks for choosing us!</p>
                <div class="my-3 box-shadow-info">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.datos-personales')}}</h3>
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
                </div>
                @if($typetransfer == 1)                    
                    <div class="my-3 box-shadow-info">
                        <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.llegada')}}</h3>
                        <div class="form-group mb-3">
                            <label for="dateArrival" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.fecha-llegada')}} <span class="text-danger font-weight-bold">*</span></label>
                            <input type="date" class="form-control" id="dateArrival" name="dateArrival" value="{{$dateArrival}}" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="hourArrival" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.hora')}}</label>
                            <input type="time" class="form-control" id="hourArrival" name="hourArrival" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="infoFlight" class="font-weight-bold fsize-sm text-gray">{{__('MotorBusqueda.info-vuelo')}}</label>
                            <input type="text" class="form-control" id="infoFlight" name="infoFlight" />
                        </div>
                    </div>
                    <div class="my-3 box-shadow-info">
                        <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.destino-label')}}</h3>
                        <p><span class="font-weight-bold text-gray">{{__('MotorBusqueda.zona')}}:</span> <span class="font-weight-bold">{{$objDestination->name}}</span></p>
                        <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.destino')}}:</span> <span class="font-weight-bold">{{$destination}}</span></P>
                        <P><span class="font-weight-bold text-gray">{{__('MotorBusqueda.pasajeros')}}:</span> <span class="font-weight-bold">{{$pax}}</span></P>
                    </div>
                @endif
                <div class="my-3 box-shadow-info">
                    <h3 class="font-weight-bold fsize-mds text-blue">{{__('MotorBusqueda.metodo-pago')}}</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="radio" name="payment_type" id="cash" checked>
                            <label for=""><img src="/img/icons/cash.png" style="width:200px;" alt="Cash"></label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="payment_type" id="paypal">
                            <label for=""><img src="/img/icons/paypal.png" style="width:200px;" alt="paypal"></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 d-grid mt-5">
                        <button class="btn btn-naranja btn-lg" type="button">{{__('MotorBusqueda.boton-confirmar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush