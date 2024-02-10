<?php
    use App\Models\Respuesta;
    use App\Models\Destination;
    
    $destination = new Destination;
    $listDestination = $destination->_GetDestinationsAirport();
?>


<div class="d-flex justify-content-center">
    <div class="box-buscador col-md-9">
        <h5 class="text-white font-weight-bold" style="font-size: 1.575rem">{{__('MotorBusqueda.inicia-reserva')}}</h5>
        <input type="hidden" id="idZone"/>
        <div class="mt-4">
            <div class="form-group mb-3">
                <label for="typetransfer" class="font-weight-bold">{{__('MotorBusqueda.type-transfer')}}</label>
                <select class="form-select select-zone p-2" name="typetransfer" id="typetransfer" onchange="HidenShowInputs()">
                        <option value="1">{{__('MotorBusqueda.aeropuerto-hotel')}}</option>
                        <option value="2">{{__('MotorBusqueda.hotel-aeropuerto')}}</option>
                        <option value="3">{{__('MotorBusqueda.redondo-aeropuerto')}}</option>
                        <option value="4">{{__('MotorBusqueda.viaje-personalizado')}}</option>
                </select> 
            </div>
            <div class="from-group mb-3 d-none" id="divorigin">
                <label for="origin" class="font-weight-bold">{{__('MotorBusqueda.origen')}}</label>
                <select class="form-control search-locations p-3" name="origin" id="origin" >
                    <option value="" disabled selected>{{__('MotorBusqueda.placeholder-origen')}}</option>
                </select>                
            </div>
            <div class="from-group mb-3" id="divdestination">
                <label for="destination" class="font-weight-bold">{{__('MotorBusqueda.destino')}}</label>
                <select class="form-control search-locations p-3" name="destination" id="destination">
                    <option value="" disabled selected>{{__('MotorBusqueda.placeholder-destino')}}</option>
                </select>                
            </div>
            <div class="form-froup mb-3 d-none" id="divcustomorigin">
                <label for="originCustom" class="font-weight-bold">{{__('MotorBusqueda.origen')}}</label>
                <input type="text" class="form-control" id="originCustom" name="originCustom" placeholder="{{__('MotorBusqueda.placeholder-custom-origen')}}"/>
            </div>
            <div class="form-froup mb-3 d-none" id="divcustomdestination">
                <label for="destinationCustom" class="font-weight-bold">{{__('MotorBusqueda.destino')}}</label>
                <input type="text" class="form-control" id="destinationCustom" name="destinationCustom" placeholder="{{__('MotorBusqueda.placeholder-custom-destino')}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="pax" class="font-weight-bold">{{__('MotorBusqueda.pasajeros')}}</label>
                <input type="number" class="form-control p-2" min="1" value='1' name="pax" id="pax"/>
            </div>
            <div class="form-group mb-3" id="divarrival">
                <label for="dateArrival" class="font-weight-bold">{{__('MotorBusqueda.fecha-llegada')}}</label>
                <input class="form-control form-control-date p-2" type="date" name="dateArrival" id="dateArrival" onclick="handleShowPicker(this)">
            </div>
            <div class="form-group d-none mb-3" id="divdeparture">
                <label for="dateDeparture" class="font-weight-bold">{{__('MotorBusqueda.fecha-salida')}}</label>
                <input class="form-control p-2" type="date" name="dateDeparture" id="dateDeparture" onclick="handleShowPicker(this)">
            </div>            
            <div class="d-grid">
                <button class="btn btn-naranja btn-lg" type="button" onclick="SearchTrip()">{{__('MotorBusqueda.btn-reserva')}}</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('.select-zone').select2()
    })

    var locations = "";
    var listZone = "";
    var destination = document.getElementById('destination');
    var origin = document.getElementById('origin');
    var dateArrival = document.getElementById('dateArrival')
    var dateDeparture = document.getElementById('dateDeparture')
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
    dateArrival.setAttribute('min', minDay)
    dateDeparture.setAttribute('min', minDay)
    
    
    function comprobarFecha(fecha) {
        return Date.parse(fecha) < Date.parse(minDay)
    }

    

    function getZone() {
        fetch('/back/zone')
        .then(res => res.json())
        .then(result => {
            getLocations(result?.data);
        });
    }

    getZone();

    function getLocations(ListZone = []){
        fetch('/back/locations', {
            method: 'POST',
            headers: headConexion            
        })
        .then(res => res.json())
        .then(result => {
            $('.search-locations').select2({
            data: makeDataToSelect(ListZone, result.data),
            matcher: matchDataLocation
            
            })            
        });
    }
    
    function HidenShowInputs()
    {
        var typetransfer = $('#typetransfer').val()

        if(typetransfer == 1)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divarrival').removeClass("d-none")
            $('#divdeparture').addClass("d-none")
            $('#divcustomorigin').addClass("d-none");
            $('#divcustomdestination').addClass("d-none");
        }
        else if(typetransfer == 2)
        {
            $('#divdestination').addClass("d-none")
            $('#divorigin').removeClass("d-none")
            $('#divarrival').addClass("d-none")
            $('#divdeparture').removeClass("d-none")
            $('#divcustomorigin').addClass("d-none");
            $('#divcustomdestination').addClass("d-none");
        }
        else if(typetransfer == 3)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divarrival').removeClass("d-none")
            $('#divdeparture').removeClass("d-none")
            $('#divcustomorigin').addClass("d-none");
            $('#divcustomdestination').addClass("d-none");
            // $("#divzone").removeClass("d-none")
        }    
        else if(typetransfer == 4)
        {
            $('#divdestination').addClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divdeparture').removeClass("d-none")
            $('#divarrival').addClass("d-none")
            $('#divcustomorigin').removeClass("d-none");
            $('#divcustomdestination').removeClass("d-none");
            // $("#divzone").addClass("d-none")
        }
    }
    function SearchTrip()
    {
        // var zone = $('#zone').val()        
        var origin = $('#origin').val();
        var destination = $('#destination').val();
        var originCustom = $('#originCustom').val();
        var destinationCustom = $('#destinationCustom').val();
        var typetransfer = $('#typetransfer').val();
        var dateArrival = $('#dateArrival').val();
        var dateDeparture = $('#dateDeparture').val();
        var pax = $('#pax').val();
        var pathURL = '';
        
        if(typetransfer == 1 && (dateArrival == '' || comprobarFecha(dateArrival))){
            notification('error', '{{__('MotorBusqueda.input-requerido-date-arrival')}}')
            return false            
        }
        else if([2,4].indexOf(parseInt(typetransfer)) > -1 && (dateDeparture == '' || comprobarFecha(dateDeparture))){
            notification('error', '{{__('MotorBusqueda.input-requerido-date-departure')}}')
            return false
        }
        else if(typetransfer == 3 && (dateArrival == '' || comprobarFecha(dateArrival) || dateDeparture == '' || comprobarFecha(dateDeparture))){
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
        else if(typetransfer == 4 && (originCustom == "" || destinationCustom == ""))
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-origen-destino')}}')
            return false
        }

        pathURL = `/{{__('MotorBusqueda.url-detail')}}?typetransfer=${typetransfer}&datearrival=${dateArrival}&datedeparture=${dateDeparture}&pax=${pax}`
        
        if(typetransfer == 4) {
            pathURL = pathURL + `&origin=${originCustom}&destination=${destinationCustom}` ;
        } else {
            pathURL = pathURL + `&origin=${origin}&destination=${destination}`
        }
        window.location.href = pathURL;
        
    }
</script>