async function getVehicles() {
    var contentGroupVehicle = document.getElementById('content-group-vehicle');
    contentGroupVehicle.innerHTML = '';

    var canEditVehicle = await validPermision('EDITAR_VEHICULOS');
    var canDeleteVehicle = await validPermision('ELIMINAR_VEHICULOS');

    fetch('/admin-marcshuttle/get-vehicles')
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            result.data.map(item => {
                var element = `<div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="d-flex justify-content-between">
                                <div class="font-weight-bold text-primary text-uppercase mb-1 fsize-sm">${item.name}</div>
                                <div class="d-flex justify-content-between">
                                    ${canEditVehicle ? 
                                        '<div class="mr-2"><button type="button" class="d-flex align-center btn btn-outline-primary" onclick="showModalVehicle('+item.id+')"><i class="fa fa-pencil" style="font-size: 1.4em;" aria-hidden="true"></i></button></div>' 
                                        : ''
                                    }
                                    ${canDeleteVehicle ? 
                                        '<div><button type="button" class="d-flex align-center btn btn-outline-danger" onclick="confirmDelete('+item.id+', deleteVehicle)"><i class="fa fa-trash" style="font-size: 1.4em;" aria-hidden="true"></i></button></div>'
                                        : ''
                                    }
                                    
                                </div>
                            </div>
                            <div class="">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">pax</div>
                                <span>${item.min_pax} - ${item.max_pax}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            contentGroupVehicle.insertAdjacentHTML('beforeend', element);
            })
        }
    })
}

$(document).ready(() => {
    getVehicles();

    $('.required').change(() => {
        var btnSaveVehicle = document.getElementById('btn-save-vehicle');
        var formVehicle = document.getElementById('form-vehicle');
        var elementsRequired = formVehicle.querySelectorAll('.required');
        
        elementsRequired.forEach(item => {  
            if(item.value == "" || item.value == 0) 
                btnSaveVehicle.setAttribute('disabled', true);
            else
                btnSaveVehicle.removeAttribute('disabled');
        });
    })

    var imgVehicleFile = document.getElementById('imgVehicleFile');
    var contentImgCard = document.getElementById('content-img-card');

    imgVehicleFile.addEventListener('change', e => {
        e.preventDefault();

        if(!validSizeFile(imgVehicleFile.files[0].size)) {
            imgVehicleFile.value = '';
            return false;
        }

        var renderImg = new FileReader();
        var imgVehicle = document.getElementById('img-vehicle');

        renderImg.onload = function(evt) {
            imgVehicle.src = evt.target.result;
            contentImgCard.classList.add('content-img-card-admin');
            imgVehicle.setAttribute('style', 'width:100%; height:100%');
        }

        renderImg.readAsDataURL(imgVehicleFile.files[0]);
    })

    $('#btn-save-vehicle').click(() => {

        var vehicle = {
            name: $('#nameVehicle').val(),
            min_pax: $('#minPax').val(),
            max_pax: $('#maxPax').val()
        }

        var imgVehicleFile = document.getElementById('imgVehicleFile');

        if($('#idVehicle').val() != '' && $('#idVehicle').val() != 0) {
            vehicle.id = $('#idVehicle').val();
            if(imgVehicleFile.files.length > 0) {
                if(!validSizeFile(imgVehicleFile.files[0].size)) {            
                    imgVehicleFile.value = '';
                    return false
                }
            } else {
                updateVehicle(vehicle);
            }
        } 


        const reader = new FileReader();

        reader.onload = function(evt) {
            vehicle.imagen = evt?.target?.result;
            vehicle.name_image = $('#nameVehicle').val().replaceAll(' ','-');

            if($('#idVehicle').val() == '' && $('#idVehicle').val() == 0)
                saveVehicle(vehicle);
            else 
                updateVehicle(vehicle);
        }
        reader.readAsDataURL(imgVehicleFile.files[0]);
    })
})

function saveVehicle(vehicle) {
    activeLoader('Guardando...', 'Se esta guardando los datos');
    fetch('/admin-marcshuttle/save-vehicle', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify(vehicle)
    })
    .then(res => res.json())
    .then(result => {
        console.log(result)
        closeAlert();
        if(result.error == false) {
            getVehicles();
            notification('success', 'Se guardo correctamente el vehiculo');
            $('#modalVehicle').modal('hide');
        }
        else
            notification('error', result.message);
    })
}

function updateVehicle(vehicle) {
    activeLoader('Actualizando...', 'Actualizando los datos del tour');

    fetch('/admin-marcshuttle/update-vehicle', {
        method: 'PUT',
        headers: headConexion,
        body: JSON.stringify(vehicle)
    })
    .then(res => res.json())
    .then(result => {
        console.log(result)
        if(result.error == false) {
            getVehicles();
            notification('success', 'Se actualio correctamente el vehiculo');
            $('#modalVehicle').modal('hide');
        }
        else
            notification('error', result.message);
    })
}

function showModalVehicle(idVehicle = '') {
    var formVehicle = document.getElementById('form-vehicle');
    var contentImgCard = document.getElementById('content-img-card');
    var imgVehicle = document.getElementById('img-vehicle');

    if(idVehicle == '' || idVehicle == 0) {
        changeBtnSave('Agregar');
        $('#idVehicle').val('');
        imgVehicle.removeAttribute('src');
        imgVehicle.removeAttribute('style');
        contentImgCard.classList.remove('content-img-card-admin');
        formVehicle.reset();
    } else {
        fetch(`/admin-marcshuttle/get-vehicle-by-id?idVehicle=${idVehicle}`)
        .then(res => res.json())
        .then(result => {
            console.log(result)
            if(result.error == false) {
                $('#idVehicle').val(result.data.id);
                $('#nameVehicle').val(result.data.name);
                $('#minPax').val(result.data.min_pax);
                $('#maxPax').val(result.data.max_pax);

                contentImgCard.classList.add('content-img-card-admin');
                imgVehicle.src = result?.data?.image_base_64 == null ? result?.data?.image : result?.data?.image_base_64;
                imgVehicle.setAttribute('style', 'width:100%; height:100%');
                $('#btn-save-vehicle').removeAttr('disabled');
                changeBtnSave('Actualizar');
            }
        })
    }
    
    $('#modalVehicle').modal('show');
}

function changeBtnSave (btnText) {
    $('#btn-save-vehicle').text(btnText);
}

function deleteVehicle(id) {
    fetch(`/admin-marcshuttle/delete-vehicle?idVehicle=${id}`, {
        method: 'DELETE',
        headers: headConexion
    })
    .then(res => res.json())
    .then(result => {
        if(result.error == false)  {
            getVehicles()
            notification('success', 'Se elimino el registro correctamente');
        }
        else
            notification('error', result.message);
    })
}