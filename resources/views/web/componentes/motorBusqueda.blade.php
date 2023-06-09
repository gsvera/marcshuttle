<?php
    use App\Models\Respuesta;
    use App\Models\Destination;
    
    $destination = new Destination;
    $listDestination = $destination->GetDestinationsAirport();
?>


<div class="d-flex justify-content-center">
    <div class="box-buscador col-md-9">
        <h3 class="text-white font-weight-bold">{{__('MotorBusqueda.inicia-reserva')}}</h3>
        <!-- <p class="text-white">{{__('MotorBusqueda.texto-1')}}</p> -->
        <div class="mt-4">
            <div class="form-group mb-3">
                <label for="typetransfer" class="font-weight-bold">{{__('MotorBusqueda.type-transfer')}}</label>
                <select class="form-select p-3" name="typetransfer" id="typetransfer" onchange="HidenShowInputs()">
                        <option value="1">{{__('MotorBusqueda.aeropuerto-hotel')}}</option>
                        <option value="2">{{__('MotorBusqueda.hotel-aeropuerto')}}</option>
                        <option value="3">{{__('MotorBusqueda.redondo-aeropuerto')}}</option>
                        <option value="4">{{__('MotorBusqueda.viaje-personalizado')}}</option>
                </select> 
            </div>
            <div class="form-group mb-3" id="divzone">
                <label for="zone" class="font-weight-bold">{{__('MotorBusqueda.zona')}}</label>
                <select name="zone" id="zone" class="form-control p-3 busquedalive">
                    <option value="">{{__('MotorBusqueda.seleccione-zona')}}</option>
                    @foreach($listDestination as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="from-group mb-3 d-none" id="divorigin">
                <label for="origin" class="font-weight-bold">{{__('MotorBusqueda.origen')}}</label>
                <input type="text" class="form-control p-3" name="origin" id="origin" placeholder="origen"/>                
                <ul id="optionOrigin" class="listOptionsLocations"></ul>
            </div>
            <div class="from-group mb-3" id="divdestination">
                <label for="destination" class="font-weight-bold">{{__('MotorBusqueda.destino')}}</label>
                <input type="text" class="form-control p-3" name="destination" id="destination" placeholder="destino"/>
                <ul id="optionDestination" class="listOptionsLocations"></ul>
            </div>
            <div class="form-group mb-3">
                <label for="pax" class="font-weight-bold">{{__('MotorBusqueda.pasajeros')}}</label>
                <input type="number" class="form-control p-3" min="1" value='1' name="pax" id="pax"/>
            </div>
            <div class="form-group mb-3" id="divarrival">
                <label for="dateArrival" class="font-weight-bold">{{__('MotorBusqueda.fecha-llegada')}}</label>
                <input class="form-control p-3" type="date" name="dateArrival" id="dateArrival" >
            </div>
            <div class="form-group d-none mb-3" id="divdeparture">
                <label for="dateDeparture" class="font-weight-bold">{{__('MotorBusqueda.fecha-salida')}}</label>
                <input class="form-control p-3" type="date" name="dateDeparture" id="dateDeparture">
            </div>            
            <div class="d-grid">
                <button class="btn btn-naranja btn-lg" type="button" onclick="SearchTrip()">{{__('MotorBusqueda.btn-reserva')}}</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    var locations = ""
    var listLocations = ""
    var destination = document.getElementById('destination')
    var origin = document.getElementById('origin')
    var listOptionsDestination = document.getElementById('optionDestination')
    var listOptionsOrigin = document.getElementById('optionOrigin')
    var dateArrival = document.getElementById('dateArrival')
    var dateDeparture = document.getElementById('dateDeparture')
    
    getLocations();
    
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

    dateArrival.setAttribute('min', year+'-'+month+'-'+day)
    dateDeparture.setAttribute('min', year+'-'+month+'-'+day)
    
    // $('#dateArrival').datepicker({
    //     starDate: day + '/' + month + '/' + year
    // })

    //$('#dateArrival').datepicker()

    function getLocations(){
        $.ajax({
            url: '/back/locations',
            type: 'GET',
            success: function(data)
            {
                locations = data.data
            }
        })
    }
    
    function autoCompleteLocations(valor){
        
        return locations.filter(item => {
            var nombreLower = item.nombre.toLowerCase()
            var valorLower = valor.toLowerCase()
            return nombreLower.includes(valorLower)
        })
    }

    function setDestination(event){
        destination.value = event.dataset.option
        listOptionsDestination.innerHTML = ""        
    }   
    function setOrigin(event){
        origin.value = event.dataset.option
        listOptionsOrigin.innerHTML = ""        
    }   

    document.body.addEventListener("keydown", function(event) {
        // console.log(event.code, event.keyCode);
        if (event.code === 'Escape' || event.keyCode === 27 || event.code === 'Tap' || event.keyCode === 9) {
            listOptionsDestination.innerHTML = ""
            listOptionsOrigin.innerHTML = ""
            document.getElementById('pax').focus()
        }
    });


    destination.addEventListener('keyup', e => {
        e.preventDefault()                                                                                
        var locationFilter = autoCompleteLocations(destination.value)        
        listOptionsDestination.innerHTML = ""
        
        locationFilter.map((item) => {
            listOptionsDestination.insertAdjacentHTML('beforeend', `<li onclick="setDestination(this)" data-option="${item.nombre}">${item.nombre}</li>`)            
        })
    })

    origin.addEventListener('keyup', e => {
        e.preventDefault()                                                                                
        var locationFilter = autoCompleteLocations(origin.value)        
        listOptionsOrigin.innerHTML = ""
        
        locationFilter.map((item) => {
            listOptionsOrigin.insertAdjacentHTML('beforeend', `<li onclick="setOrigin(this)" data-option="${item.nombre}">${item.nombre}</li>`)            
        })
    })
    
    function HidenShowInputs()
    {
        var typetransfer = $('#typetransfer').val()

        if(typetransfer == 1)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divarrival').removeClass("d-none")
            $('#divdeparture').addClass("d-none")
            $("#divzone").removeClass("d-none")
        }
        else if(typetransfer == 2)
        {
            $('#divdestination').addClass("d-none")
            $('#divorigin').removeClass("d-none")
            $('#divarrival').addClass("d-none")
            $('#divdeparture').removeClass("d-none")
            $("#divzone").removeClass("d-none")
        }
        else if(typetransfer == 3)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').addClass("d-none")
            $('#divarrival').removeClass("d-none")
            $('#divdeparture').removeClass("d-none")
            $("#divzone").removeClass("d-none")
        }    
        else if(typetransfer == 4)
        {
            $('#divdestination').removeClass("d-none")
            $('#divorigin').removeClass("d-none")
            $('#divdeparture').removeClass("d-none")
            $('#divarrival').addClass("d-none")
            $("#divzone").addClass("d-none")
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
        
        if(typetransfer != 4)
        {
            if(zone == "")
            {
                notification('error', '{{__('MotorBusqueda.input-requerido-zona')}}')
                return false
            }
        }
        if(typetransfer == 1 && dateArrival == '')
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-date-arrival')}}')
            return false            
        }
        else if([2,4].indexOf(parseInt(typetransfer)) > -1 && dateDeparture == '')
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
        else if(typetransfer == 4 && (origin == "" || destination == ""))
        {
            notification('error', '{{__('MotorBusqueda.input-requerido-origen-destino')}}')
            return false
        }

        window.location.href = `/{{__('MotorBusqueda.url-detail')}}?zone=${zone}&origin=${origin}&destination=${destination}&typetransfer=${typetransfer}&datearrival=${dateArrival}&datedeparture=${dateDeparture}&pax=${pax}`
        
    }
</script>