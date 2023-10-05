function getLocationsByZona(nameZona = "") {
    var divZonas = document.getElementById('content-group-zonas');
    divZonas.innerHTML= "";

    fetch(`/admin-marcshuttle/get-locations?nameZona=${nameZona}`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            result.data.map(item => {
                var element = `<div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <p class="font-weight-bold text-info text-uppercase mb-1">${item.name}</p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-center">
                                <span>Total ubicaciones (${item._detail_locations.length})</span>
                            </div>
                            <div class="d-flex align-center btn btn-outline-primary" onclick="openModalLocations(${item.id})">
                                <i class="fa fa-pencil" style="font-size: 1.4em;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            divZonas.insertAdjacentHTML('beforeend', element);
            })
        }
    })
}

$(document).ready(() => {
    getLocationsByZona();
})

function searchZoneLocations(){
    getLocationsByZona($('#search-zona-locations').val());
}

function openModalLocations(idZona) {
    var contentLocaciones = document.getElementById('contentLocaciones');
    contentLocaciones.innerHTML = "";
    fetch(`/admin-marcshuttle/get-location-by-id?id=${idZona}`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            $('#nameZonaLabel').text(result.data[0].name)
            $('#idZona').val(result.data[0].id)
            result.data[0]._detail_locations.map(item => {
                var element = `<div class="d-flex justify-content-center">
                    <div class="col-10 p-0">
                        <input type="text" class="form-control mb-3" id="location-${item.id}" value="${item.nombre}" onchange="handleLocation(this, ${item.id})" />
                    </div>
                    <div class="col-1">
                        <button class="btn btn-info" type="button" onclick="updateLocation(${item.id})" id="btn-location-${item.id}" disabled>
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>`;
                
                contentLocaciones.insertAdjacentHTML('beforeend', element)
            })
            $('#modalLocations').modal('show');
        }
    })
}

function addZona() {
    if($('#newUbication').val() == '') {
        notification('error', 'Debe agregar el nombre de una ubicacion');
        return false
    }

    fetch('/admin-marcshuttle/create-location', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify({nameLocation: $('#newUbication').val(), idZona: $('#idZona').val()})
    })
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            openModalLocations($('#idZona').val());
            notification('success', 'Locacion guardada correctamente');
        }
        else {
            notification('error', result.message);
        }
    })
}

function updateLocation(idLocation) {
    if($('#location-'+idLocation).val() == '') {
        notification('error', 'El nombre de locacion no puede ir vacion');
        return false
    }

    var location = {
        id: idLocation,
        name: $('#location-'+idLocation).val()
    };

    fetch('/admin-marcshuttle/update-location', {
        method: 'PUT',
        headers: headConexion,
        body: JSON.stringify(location)
    })
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            openModalLocations($('#idZona').val());
            notification('success', 'Locacion actualizada correctamente');
        }
        else {
            notification('error', result.message);
        }
    })
}

function handleLocation(element, idLocation) {
    if(element.value != '') 
        $('#btn-location-'+idLocation).removeAttr('disabled')
    else
        $('#btn-location-'+idLocation).attr('disabled', true)
}