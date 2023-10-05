function menuHome() {
    window.location.reload();
}

function menuUser() {
    $('#content-body').load('/admin-marcshuttle/user')
}

function menuZonas(){
    $('#content-body').load('/admin-marcshuttle/zona')
}

function menuLocations() {
    $('#content-body').load('/admin-marcshuttle/location')
}

function menuTours() {
    $('#content-body').load('/admin-marcshuttle/tour');
}

function menuVehicles() {
    $('#content-body').load('/admin-marcshuttle/vehicle');
}

function menuBookingsTripReport() {
    $('#content-body').load('/admin-marcshuttle/bookins-trip-report');
}

function menuBookingsTourReport() {
    $('#content-body').load('/admin-marcshuttle/bookings-tour-report');
}

function showDataModalUser() {
    fetch('/admin-marcshuttle/get-current-data-user')
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            $('#currentFirstName').val(result?.data?.first_name);
            $('#currentLastName').val(result?.data?.last_name);
            $('#currentEmail').val(result?.data?.email);
            $('#modalDatosUser').modal('show');
        } else {
            notification('error', result.message);
        }
    })
}

function updateCurrenUser() {

    if($('#currentFirstName').val() == '' || $('#currentLastName').val() == '') {
        notification('error', 'Debe llenar los campos obligatorios');
        return false;
    }

    if(!regex.test($('#currentEmail').val())) {
        notification('error', 'El email no cumple con el formato correspondiente');
        return false
    }

    var user = {
        first_name: $('#currentFirstName').val(),
        last_name: $('#currentLastName').val(),
        email: $('#currentEmail').val()
    }

    fetch('/admin-marcshuttle/update-current-data-user', {
        method: 'PUT',
        headers: headConexion,
        body: JSON.stringify(user)
    })
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            $('#panel-name-user').text(user.first_name + ' ' + user.last_name);
            $('#modalDatosUser').modal('hide');
            notification('success', 'Se actualizaron los datos correctamente');
        }
        else {
            notification('error', result.message);
        }
    })
}

function updatePassword() {
    var currentPassword = $('#currentPassword').val();
    var newPassword = $('#newPassword').val();
    if(currentPassword == '' || !regexPassword.test(newPassword)) {
        notification('error', 'Ingrese una contraseña valida');
        return false;
    }
    if(currentPassword == newPassword) {
        notification('warning', 'Pruebe con una contraseña diferente');
        return false;
    }

    fetch('/admin-marcshuttle/change-password', {
        method: 'PUT',
        headers: headConexion,
        body: JSON.stringify({currentPassword, newPassword})
    })
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            $('#modalChangePassword').modal('hide');
            notification('success', 'Se actualizo la contraseña correctamente');
        } else {
            notification('error', result.message);
        }
    })
}

$(document).ready(() => {
    $('#div-chart').load('/admin-marcshuttle/chart');
})