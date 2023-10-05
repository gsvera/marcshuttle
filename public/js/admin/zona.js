function getZonas(nameZona = '') {
    var tableBodyZonas = document.getElementById('table-body-zona');
    tableBodyZonas.innerHTML = "";

    fetch(`/admin-marcshuttle/getZonas?namezona=${nameZona}`)
    .then(res => res.json())
    .then(result => {        
        if(result.error == false) {
            result.data.map(item => {
                var element = `<tr>
                    <td>${item.name}</td>
                    <td class="text-center">${convertCurrency(item.uno_tres)}</td>
                    <td class="text-center">${convertCurrency(item.cuatro_siete)}</td>
                    <td class="text-center">${convertCurrency(item.ocho_diez)}</td>
                    <td class="text-center">
                        <button class="btn btn-outline-primary" onclick="openModalEditZona(${item.id})"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    </td>
                </tr>`;

                tableBodyZonas.insertAdjacentHTML('beforeend', element);
            })
        }
    })
}

function fireSearchZone() {
    getZonas($('#search-zona').val());
}
$(document).ready(() => {
    getZonas();

    $('.required').change(() => {
        var btnSave = document.getElementById('btn-save-zona');  
        var formZona = document.getElementById('form-zona');
        var elementsRequired = formZona.querySelectorAll('.required');
        
        elementsRequired.forEach(item => {
            if(item.value == "") {
                btnSave.setAttribute('disabled', true);
                return false;
            }
            if(item.getAttribute('class').includes('required-price'))
                if(acceptOnlyPrice(item.value)) {
                    btnSave.setAttribute('disabled', true);
                    return false;
                }
            else 
                btnSave.removeAttribute('disabled');
        })
    })

    $('#btn-save-zona').click(() => {
        if($('#nameZona').val() == '') {
            notification('error', 'Ingresa un nombre valido');
            return false
        }

        var zona = {
            name: $('#nameZona').val(),
            uno_tres: $('#unoTres').val(),
            cuatro_siete: $('#cuatroSiete').val(),
            ocho_diez: $('#ochoDiez').val()
        };

        if($('#idZona').val() != '') {
            zona.id = $('#idZona').val();
            updateZona(zona);
        } else {
            createZona(zona);
        }

    })
})

function createZona(zona) {
    activeLoader('Guardando', 'Guardando datos de zona');

    fetch('/admin-marcshuttle/create-zona', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify(zona)
    })
    .then(res => res.json())
    .then(result => {
        closeAlert();
        if(result.error == false) {
            getZonas();
            $('#modalZona').modal('hide');
            notification('success', 'Se ha guardado correctamente la zona');
        } else {
            notification('error', result.message);
        }
    })
}

function updateZona(zona) {
    activeLoader('Actualizando', 'Actualizando datos de zona');

    fetch('/admin-marcshuttle/update-zona', {
        method: 'PUT',
        headers: headConexion,
        body: JSON.stringify(zona)
    })
    .then(res => res.json())
    .then(result => {
        console.log(result);
        closeAlert();
        if(result.error == false) {
            getZonas();
            $('#modalZona').modal('hide');
            notification('success', 'Se ha actualizado correctamente la zona');
        }
        else {
            notification('error', result.message);
        }
    })
}

function openModalAdd() {
    var formZona = document.getElementById('form-zona');
    formZona.reset();
    $('#idZona').val();
    $('#modalZona').modal('show');
}

function openModalEditZona(id) {
    fetch(`/admin-marcshuttle/get-zona-by-id?id=${id}`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            $('#idZona').val(result.data.id);
            $('#nameZona').val(result.data.name);
            $('#unoTres').val(result.data.uno_tres);
            $('#cuatroSiete').val(result.data.cuatro_siete);
            $('#ochoDiez').val(result.data.ocho_diez);
            $('#btn-save-zona').removeAttr('disabled');
            $('#modalZona').modal('show');
        } else {
            notification('error', result.message);
        }
    })
}

