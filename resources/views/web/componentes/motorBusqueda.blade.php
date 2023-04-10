<?php
    use App\Models\Respuesta;
    use App\Models\Destination;
    
    $destination = new Destination;
    $listDestination = $destination->GetDestinationsAirport();
?>


<div class="d-flex justify-content-center">
    <div class="box-buscador col-md-9">
        <h3 class="text-white font-weight-bold">{{__('MotorBusqueda.slogan')}}</h3>
        <p class="text-white">{{__('MotorBusqueda.texto-1')}}</p>
        <div class="mt-4">
            <div class="form-group mb-3">
                <label for="typetransfer" class="font-weight-bold">{{__('MotorBusqueda.type-transfer')}}</label>
                <select class="form-select p-3" name="typetransfer" id="typetransfer" onchange="HidenShowInputs()">
                        <option value="1">{{__('MotorBusqueda.aeropuerto-hotel')}}</option>
                        <option value="2">{{__('MotorBusqueda.hotel-aeropuerto')}}</option>
                        <option value="3">{{__('MotorBusqueda.redondo-aeropuerto')}}</option>
                </select> 
            </div>
            <div class="form-group mb-3">
                <label for="zone" class="font-weight-bold">{{__('MotorBusqueda.zona')}}</label>
                <select name="zone" id="zone" class="form-control p-3">
                    <option value="">{{__('MotorBusqueda.seleccione-zona')}}</option>
                    @foreach($listDestination as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="from-group mb-3 d-none" id="divorigin">
                <label for="origin" class="font-weight-bold">{{__('MotorBusqueda.origen')}}</label>
                <input type="text" class="form-control p-3" name="origin" id="origin" placeholder="origen"/>
            </div>
            <div class="from-group mb-3" id="divdestination">
                <label for="destination" class="font-weight-bold">{{__('MotorBusqueda.destino')}}</label>
                <input type="text" class="form-control p-3" name="destination" id="destination" placeholder="destino"/>
            </div>
            <div class="form-group mb-3">
                <label for="pax" class="font-weight-bold">{{__('MotorBusqueda.pasajeros')}}</label>
                <input type="number" class="form-control p-3" min="1" value='1' name="pax" id="pax"/>
            </div>
            <div class="form-group mb-3" id="divarrival">
                <label for="dateArrival" class="font-weight-bold">{{__('MotorBusqueda.fecha-llegada')}}</label>
                <input class="form-control p-3" type="date" name="dateArrival" id="dateArrival">
            </div>
            <div class="form-group d-none mb-3" id="divdeparture">
                <label for="dateDeparture" class="font-weight-bold">{{__('MotorBusqueda.fecha-salida')}}</label>
                <input class="form-control p-3" type="date" name="dateDeparture" id="dateDeparture">
            </div>            
            <div class="d-grid">
                <button class="btn btn-naranja btn-lg" type="button" onclick="SearchTrip()">{{__('MotorBusqueda.boton-buscar')}}</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function HidenShowInputs()
    {
        var typetransfer = $('#typetransfer').val()

        if(typetransfer == 1)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divarrival').removeClass("d-none")
            $('#divdeparture').addClass("d-none")
        }
        else if(typetransfer == 2)
        {
            $('#divdestination').addClass("d-none")
            $('#divorigin').removeClass("d-none")
            $('#divarrival').addClass("d-none")
            $('#divdeparture').removeClass("d-none")
        }
        else if(typetransfer == 3)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divarrival').removeClass("d-none")
            $('#divdeparture').removeClass("d-none")
        }    
    }
    function SearchTrip()
    {
        var zone = $('#zone').val()        
        var origin = $('#origin').val()
        var destination = $('#destination').val()
        var typetransfer = $('#typetransfer').val()
        var dateArrival = $('#dateArrival').val()
        var dateDeparture = $('#dateDeparture').val()
        var pax = $('#pax').val()
        
        if(zone == "")
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-zona')}}')
            return false
        }
        if(typetransfer == 1 && dateArrival == '')
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-date-arrival')}}')
            return false            
        }
        else if(typetransfer == 2 && dateDeparture == '')
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-date-departure')}}')
            return false
        }
        else if(typetransfer == 3 && (dateArrival == '' || dateDeparture == ''))
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-date-arrival-departure')}}')
            return false
        }
        if([1,3].indexOf(parseInt(typetransfer)) > -1 && destination == "")
        {            
            notification('error', '{{__('MotorBusqueda.input-requerido-destino')}}')
            return false            
        }
        else if([2].indexOf(parseInt(typetransfer)) > -1 && origin == "")
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-origen')}}')
            return false
        }

        window.location.href = `/{{__('MotorBusqueda.url-detail')}}?zone=${zone}&origin=${origin}&destination=${destination}&typetransfer=${typetransfer}&datearrival=${dateArrival}&datedeparture=${dateDeparture}&pax=${pax}`
        
    }
</script>