var arrayVehicle = [];

async function getTours(nameTour = "") {
    var contentGroupTour = document.getElementById('content-group-tour');
    contentGroupTour.innerHTML = "";

    var canEditTours = await validPermision('EDITAR_TOURS');

    fetch(`/admin-marcshuttle/get-tours?nameTour=${nameTour}`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false){
            result.data.map(item => {
                var element = `<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="d-flex justify-content-between">
                                        <div class="font-weight-bold text-success text-uppercase mb-1 fsize-sm">
                                            ${item.name}
                                        </div> 
                                        <div>
                                        ${canEditTours ? 
                                            '<button type="button" class="d-flex align-center btn btn-outline-success" onclick="openModalTour('+item.id+')"><i class="fa fa-pencil" style="font-size: 1.4em;" aria-hidden="true"></i></button>'
                                            : ''
                                        }
                                            
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        ${item.__prices_by_vehicle.map(item => renderVehicle(item)).join("<hr/>")}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                contentGroupTour.insertAdjacentHTML('beforeend', element);
            })
        }
    })
}

function renderVehicle(item) {
    return `<div class="d-flex">
        <div class="col-5 p-0">
            <div class="font-weight-bold">${item.name}</div>
            <div class="fsize-xs">${convertCurrency(item.price)}</div>
        </div>
        <div class="col-2 p-0 justify-content-center" style="align-items:center; display:flex;">
            <div>
            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            </div>
        </div>
        <div class="col-5 p-0 text-center">
            <div class="font-weight-bold">Pax</div>
            <div class="fsize-xs">${item.min_pax} - ${item.max_pax}</div>
        </div>
    </div>`;
}

$(document).ready(() => {

    getTours();
    var imgTourFile = document.getElementById('imgTourFile');
    var contentImgCard = document.getElementById('content-img-card');
    var imgTour = document.getElementById('img-tour');

    imgTourFile.addEventListener('change', e => {
        e.preventDefault();
        
        if(!validSizeFile(imgTourFile.files[0].size)) {      
            imgTourFile.value = '';
            return false
        }

        var renderImg = new FileReader();
        var imgTour = document.getElementById('img-tour');

        renderImg.onload = function(evt) {
            imgTour.src = evt.target.result;
            contentImgCard.classList.add('content-img-card-admin');
            imgTour.setAttribute('style', 'width:100%; height:100%');
        }

        renderImg.readAsDataURL(imgTourFile.files[0])
    })

    $('.required').change(() => {
        var btnSaveTour = document.getElementById('btn-save-tour');
        var formTour = document.getElementById('form-tour');
        var elementsRequired = formTour.querySelectorAll('.required');
        
        elementsRequired.forEach(item => {  
            if(item.value == "" || item.value == 0) 
                btnSaveTour.setAttribute('disabled', true);
            else
                btnSaveTour.removeAttribute('disabled');
        });
    });

    $('#btn-save-tour').click(() => {
        var tour = {
            name: $('#nameTour').val(),
            description_es: $('#descriptionEs').val(),
            description_en: $('#descriptionEn').val()  
        };

        var aux = 0;
        var pricesVehicles = [];
        arrayVehicle.map(item => {
            if(!validOnlyPrice($('#vehicle-'+item).val())) {
                var vehicle = {
                    id: item,
                    price: $('#vehicle-'+item).val()
                };
                pricesVehicles.push(vehicle);
                aux++;
            }
        })

        if(pricesVehicles.length == 0) {
            notification('error', 'Debe agregar al menos un precio');
            return false
        }

        tour.array_vehicle = pricesVehicles;

        var imgTourFile = document.getElementById('imgTourFile');

        if($('#idTour').val() != 0 && $('#idTour').val() != '') {
            tour.id = $('#idTour').val();
            if(imgTourFile.files.length > 0) {
                if(!validSizeFile(imgTourFile.files[0].size)) {            
                    imgTourFile.value = '';
                    return false
                }    
            } else {
                updateTour(tour);
                return false;
            }
        } else {
            if(!validSizeFile(imgTourFile.files[0].size)) {            
                imgTourFile.value = '';
                return false
            }
        }

        const reader = new FileReader();

        reader.onload = function(evt) {
            const imagenData = evt?.target?.result;
            tour.imagen = imagenData;
            tour.name_image = $('#nameTour').val().replaceAll(' ', '-');
    
            if($('#idTour').val() == '' || $('#idTour').val() == 0)
                saveTour(tour);
            else 
                updateTour(tour);
        }
        reader.readAsDataURL(imgTourFile.files[0])
    })
})

function fireSearchTour() {
    getTours($('#search-tour').val());
}

function openModalTour(idTour = '') {
    var formTour = document.getElementById('form-tour');
    var contentVehiclesForm = document.getElementById('content-vehicles-form');
    var contentImgCard = document.getElementById('content-img-card');
    var imgTour = document.getElementById('img-tour');
    contentVehiclesForm.innerHTML = "";

    fetch('/admin-marcshuttle/get-vehicles')
    .then(res =>res.json())
    .then(result => {        
        if(result.error == false) {
            arrayVehicle.length = 0;
            result.data.map(item => {
                arrayVehicle.push(item.id);
                var element = `<div class="form-group">
                    <label class="font-weight-bold text-secondary fsize-xs">Precio de transporte: ${item.name} <span>pax: ${item.min_pax} - ${item.max_pax}</span></label>
                    <input type="text" name="vehicle-${item.id}" id="vehicle-${item.id}" class="form-control required-price" onchange="acceptOnlyPrice(this.value)">
                </div>`;
                contentVehiclesForm.insertAdjacentHTML('beforeend', element);
            })
        }
    })

    if(idTour == '' || idTour == 0) {
        changeBtnSave('Guardar')
        $('#idTour').val('');
        imgTour.removeAttribute('style');
        imgTour.removeAttribute('src');
        contentImgCard.classList.remove('content-img-card-admin');
        formTour.reset();
        $('#modalTours').modal('show');
    } else {
        fetch(`/admin-marcshuttle/get-tour-by-id?idTour=${idTour}`)
        .then(res => res.json())
        .then(result => {
            if(result.error == false) {
                $('#idTour').val(result.data.id);
                $('#nameTour').val(result.data.name);
                $('#descriptionEs').val(result?.data?.descripcion_es);
                $('#descriptionEn').val(result?.data?.descripcion_en);

                contentImgCard.classList.add('content-img-card-admin')
                imgTour.setAttribute('src', result?.data?.image_base_64 == null ? result?.data?.image : result?.data?.image_base_64);
                imgTour.setAttribute('style', 'width:100%; height:100%');

                result?.data?.__prices_by_vehicle?.map(item => {
                    $('#vehicle-'+item.vehicle_id).val(item.price);
                })
                $('#btn-save-tour').removeAttr('disabled')
                changeBtnSave('Actualizar')
                $('#modalTours').modal('show');
            }
        })
    }
}

function changeBtnSave (btnText) {
    $('#btn-save-tour').text(btnText);
}

function saveTour(tour) {
    var imgTourFile = document.getElementById('imgTourFile');
    activeLoader('Guardando...', 'Se esta guardando los datos');
    fetch('/admin-marcshuttle/save-tour', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify(tour)
    })
    .then(res => res.json())
    .then(result => {
        closeAlert();
        if(result.error == false) {
            getTours($('#search-tour').val());
            imgTourFile.value = '';
            notification('success', 'Se guardo correctamente el tour');
            $('#modalTours').modal('hide');
        } else {
            notification('error', result.message);
        }
    })
}

function updateTour(tour){
    var imgTourFile = document.getElementById('imgTourFile');
    activeLoader('Actualizando...', 'Actualizando los datos del tour');
    fetch('/admin-marcshuttle/update-tour', {
        method: "PUT",
        headers: headConexion,
        body: JSON.stringify(tour)
    })
    .then(res => res.json())
    .then(result => {
        closeAlert();
        if(result.error == false) {
            imgTourFile.value = '';
            getTours($('#search-tour').val());
            notification('success', 'Se actualizo correctamente el tour');
            $('#modalTours').modal('hide');
        } else {
            notification('error', result.message);
        }
    })
}