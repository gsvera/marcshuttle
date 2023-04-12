@extends('web.layouts.layout')
@section('content')
<div class="layer-about back-slider-about">    
</div>
<div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:370px;">
    <h1 class="font-weight-bold text-white fsize-xl">{{__('Home.acerca-nosotros')}}</h1>    
</div>

<div class="section">
    <div class="banner-driver">
        <div class="col-12 col-md-6 row"  style="padding:5% 0 5% 5%;">
            <div class="text-blue ls2 font-weight-bold">{{strtoupper(__('MotorBusqueda.acerca-de-nosotros'))}}</div>
            <h2 class="font-weight-bold fsize-md">About Transpo Charter Bus Company</h2>
            <div class="line-sm-blue my-2" style="margin-left: calc(var(--bs-gutter-x) * 0.5);"></div>                    
            <p class="text-gray fsize-sm mb-3">Purus porta feugiat egestas a diam sed ipsum, enim. In lectus bibendum gravida aliquet faucibus id gravida consectetur lectus imperdiet vulputate scelerisque. Tempor in aenean neque posuere. Vitae eleifend id tellus</p>
            <p class="text-gray fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim. In lectus bibendum gravida aliquet faucibus id gravida consectetur lectus imperdiet vulputate scelerisque. Tempor in aenean neque posuere. Vitae eleifend id tellus</p>                
        </div>
        </div>
        <div>
            <img class="img-driver-mobile" src="/img/banners/driver.jpg" alt="Driver">
        </div>
    </div>
</div>



@endsection
@push('scripts')
@endpush