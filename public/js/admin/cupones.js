async function getCupones() {
  var contentCupon = document.getElementById('content-group-cupones');
  contentCupon.innerHTML = '';

  fetch('/admin-marcshuttle/get-cupones')
    .then((res) => res.json())
    .then((response) => {
      if (!response.error) {
        response.data.map((item) => {
          var element = `<div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-${
              validExpirationCupon(item.expiration_date, item.active) ? 'danger' : 'success'
            } shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="d-flex align-center p-0" style="justify-content: flex-end;">
                        <div class="custom-control custom-switch">
                          <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            onchange="changeEnableCupon(${item.id}, ${item.active})" 
                            id="estatus-${item.id}" ${item.active && 'checked'}
                          >
                          <label class="custom-control-label" for="estatus-${item.id}"></label>
                        </div>
                      <button class="btn btn-small click" title="Editar" onClick="editCupon(${item.id})">
                        <i class="fa fa-pencil text-blue" aria-hidden="true"></i>
                      </button>
                      <button class="btn btn-small click" title="Eliminar" onClick="deleteCupon(${item.id})">
                        <i class="fa fa-trash text-red" arai-hidden="true"></i>
                      </button>
                    </div>
                    <div class="d-flex mt-3 mb-2" style="justify-content:space-between">
                      <div class="font-weight-bold text-secondary fsize-sm mb-1">
                        ${
                          item.clave
                        } <i class="fa fa-clone click" title="Copiar" aria-hidden="true" style="cursor: pointer; font-size:0.8em" onclick="copyText('${
            item.clave
          }')"></i>
                      </div>
                      <div class="" style="font-weight: 600;">${convertCurrency(item.amount)}</div>
                    </div>
                    <div class="d-flex">
                        <div class="text-secondary col-8 p-0 fsize-xs text-center">
                          Fecha de expiración: 
                          <br /> 
                          ${item.expiration_date}
                        </div>
                        <div class="text-secondary col-4 p-0 fsize-xs text-center">
                          Usados
                          <br />
                          ${item.count} / ${item.used}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>`;

          contentCupon.insertAdjacentHTML('beforeend', element);
        });
      }
    });
}

function changeEnableCupon(id, active) {
  fetch('/admin-marcshuttle/enabled-disabled-cupon', {
    method: 'PUT',
    headers: headConexion,
    body: JSON.stringify({ id, active })
  })
    .then((res) => res.json())
    .then((response) => {
      getCupones();
      if (!response.Error) notification('success', 'Estatus actualizado correctamente');
      else notification('error', result.message);
    });
}

function deleteCupon(id) {
  fetch('/admin-marcshuttle/delete-cupon', {
    method: 'DELETE',
    headers: headConexion,
    body: JSON.stringify({ id })
  })
    .then((res) => res.json())
    .then((response) => {
      getCupones();
      if (!response.Error) notification('success', 'Se elimino el cupon correctamente');
      else notification('error', result.message);
    });
}

function editCupon(id) {
  fetch(`/admin-marcshuttle/get-cupon-by-id?id=${id}`)
    .then((res) => res.json())
    .then((response) => {
      if (!response.Error) {
        $('#idCupon').val(response.data.id);
        $('#cupon').val(response.data.clave);
        $('#amount').val(response.data.amount);
        $('#count').val(response.data.count);
        $('#expirationDate').val(response.data.expiration_date);
        $('#modalCupones').modal('show');
      } else {
        notification('error', response.Message);
      }
    });
}

function showModalCupones() {
  var cuponForm = document.getElementById('form-cupon');
  cuponForm.reset();
  $('#modalCupones').modal('show');
}

$(document).ready(() => {
  getCupones();

  $('#cupon').change((e) => {
    $('#cupon').val(e.target.value.replaceAll(' ', ''));
  });

  $('.required').change(() => {
    var btnSaveCupon = document.getElementById('btn-save-cupon');
    var formCupon = document.getElementById('form-cupon');
    var elementsRequired = formCupon.querySelectorAll('.required');

    elementsRequired.forEach((item) => {
      if (item.value == '' || item.value == 0) btnSaveCupon.setAttribute('disabled', true);
      else btnSaveCupon.removeAttribute('disabled');
    });
  });

  $('#btn-save-cupon').click(() => {
    var cupon = {
      clave: $('#cupon').val(),
      amount: $('#amount').val(),
      count: $('#count').val(),
      expiration_date: $('#expirationDate').val()
    };

    if ($('#idCupon').val() != '') {
      cupon.id = $('#idCupon').val();
      updateCupon(cupon);
    } else saveCupon(cupon);
  });
});

function saveCupon(cupon) {
  activeLoader('Guardando...', 'Se esta guardando los datos');
  fetch('/admin-marcshuttle/save-cupon', {
    method: 'POST',
    headers: headConexion,
    body: JSON.stringify(cupon)
  })
    .then((res) => res.json())
    .then((response) => {
      closeAlert();
      if (!response.error) {
        notification('success', 'Se guardo correctamente el cupon');
        getCupones();
        $('#modalCupones').modal('hide');
      } else {
        notification('error', response.message);
      }
    })
    .catch((error) => console.log(error));
}
function updateCupon(cupon) {
  activeLoader('Actualizando...', 'Se esta actualizando los datos');
  fetch('/admin-marcshuttle/update-cupon', {
    method: 'PUT',
    headers: headConexion,
    body: JSON.stringify(cupon)
  })
    .then((res) => res.json())
    .then((response) => {
      if (!response.Error) notification('success', 'Se actualizo correctamente el registro');
      else notification('error', response.Message);

      getCupones();
      $('#modalCupones').modal('hide');
    });
}
