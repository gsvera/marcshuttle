@extends('web.layouts.layout')
@section('content')
<div class="layer-about back-slider-thanks"></div>
<div class="row elementup m-0 col-12 col-md-12 text-center align-center" style="height:370px;">
    <h1 class="font-weight-bold text-white fsize-xl">{{__('Home.gracias')}}</h1>    
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        //  actualiza boton menu para el home
        document.getElementById('btbMenuBook').setAttribute('href', '/')
    </script>

@endpush