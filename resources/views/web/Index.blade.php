@extends('web.layouts.layout')
@section('content')
    <div class="layer-home back-slider-home"></div>
    <div class="d-flex mt-5">
        <div class="col-md-6 mt-5" style="align-items:center;padding-left:80px;">
            <p class="text-cian" style="letter-spacing:2px;">TRANSPO</p>
            <h1 class="font-weight-bold text-white fsize-xl">{{__('Home.titulo-inicio')}}</h1>
            <p class="font-weight-bold text-white">{{__('Home.texto-principal')}}</p>
            <button class="btn btn-white-contac btn-lg font-weight-bold">{{__('Home.contactanos')}}</button>
        </div>
        <div class="col-md-6">
            <div id="motorbusqueda"></div>
        </div>
    </div>


@endsection

@push('scripts')
    <script type="text/javascript">        
        $('#motorbusqueda').load('/motorbusqueda');
    </script>
@endpush