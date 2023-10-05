function getUsers() {
    var tableBodyUser = document.getElementById('table-body-user');
    tableBodyUser.innerHTML = '';
    fetch('/admin-marcshuttle/getUsers')
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {

            result.data.map(item => {
                var elementRow = `<tr>
                    <td>${item.first_name} ${item.last_name}</td>
                    <td>${item.email}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" onchange="changeEnableUser(${item.id}, ${item.estatus})" id="estatus-${item.id}" ${item.estatus == 1 ? 'checked' : ''}>
                            <label class="custom-control-label" for="estatus-${item.id}"></label>
                        </div>
                    
                    <td><button class="btn btn-outline-primary" onclick="editUser(${item.id})"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                </tr>`;
                tableBodyUser.insertAdjacentHTML('beforeend', elementRow);
            })
        }
    })
}

$(document).ready(function() {
    getUsers()
    
    fetch('/admin-marcshuttle/getProfiles')
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            var profileSelect = document.getElementById('profile');

            result.data.map(item => {
                var elementOption = `<option value="${item.id}">${item.perfil}</option>`;
                profileSelect.insertAdjacentHTML('beforeend', elementOption);
            })
        }
    })

    $('.required').change(() => {
        var btnSave = document.getElementById('btn-save');
        var formUser = document.getElementById('form-user');
        var elementsRequired = formUser.querySelectorAll('.required');
        
        elementsRequired.forEach(item => {  
            if(item.value == "" || item.value == 0) 
                btnSave.setAttribute('disabled', true);
            else
                btnSave.removeAttribute('disabled');
        })
    })

    $('#btn-save').click(() => {
        if(!regex.test($('#email').val())) {
            notification('error', 'El email no cumple con el formato correspondiente');
            return
        }
    
        var usuario = {
            first_name: $('#firstName').val(),
            last_name: $('#lastName').val(),
            email: $('#email').val(),
            id_profile: $('#profile').val()
        }

        if($('#idUser').val() != '') {
            usuario.id = $('#idUser').val()
            UpdateUser(usuario);
        }
        else {
            if(!regexPassword.test($('#password').val())) {
                notification("error", 'Ingrese una contraseña valida')
                return false
            }
            else {
                usuario.password = $('#password').val();
                NewUser(usuario);
            }
        }
    })
})


function NewUser(usuario){
    activeLoader('Guardando','Guardando datos');
    fetch('/admin-marcshuttle/create-user', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify(usuario)
    })
    .then(res => res.json())
    .then(result => {
        closeAlert();
        getUsers()
        setTimeout(function(){
            if(result.error == false) {                    
                $('#modalUser').modal('hide');
                notification('success', 'Nuevo usuario creado');
            }
            else
                notification("error", result.message);                                
        },10)
    })
}

function UpdateUser(usuario) {
    activeLoader('Guardando','Guardando datos');
    fetch('/admin-marcshuttle/update-user', {
        method: 'PUT',
        headers:headConexion,
        body: JSON.stringify(usuario)
    })
    .then(res => res.json())
    .then(result => {
        console.log(result)
        closeAlert();
        getUsers();
        if(result.error == false){
            $('#modalUser').modal('hide');
            notification('success', 'Usuario actualizado correctamente');
        }
        else
            notification('error', result.message);
    })
}

function changeBtnSave (btnText) {
    $('#btn-save').text(btnText);
}

function showModalUser() {
    resetForm(document.getElementById('form-user'));
    changeBtnSave('Guardar');
    $('#idUser').val('');
    $('#password').addClass('required')
    $('#divPassword').removeClass('d-none');
    $('#modalUser').modal('show');
}

function editUser(id) {
    var btnSave = document.getElementById('btn-save');
    btnSave.removeAttribute('disabled');
    changeBtnSave('Editar');
    $('#password').removeClass('required');
    $('#divPassword').addClass('d-none');
    resetForm(document.getElementById('form-user'));

    fetch('/admin-marcshuttle/getUserById?id='+id)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            $('#idUser').val(result?.data?.id);
            $('#firstName').val(result?.data?.first_name);
            $('#lastName').val(result?.data?.last_name);
            $('#email').val(result?.data?.email);
            $('#profile').val(result?.data?.id_profile);
            $('#modalUser').modal('show');
        }
        else {
            notification('error', resp.message);
        }
    })
}

function changeEnableUser(id, estatus){
    fetch('/admin-marcshuttle/enabled-disabled-user', {
        method: 'PUT',
        headers: headConexion,
        body: JSON.stringify({id, estatus})
    })
    .then(res => res.json())
    .then(result => {
        if(result.error == false) 
            notification('success', 'Estatus actualizado correctamente');
        else
            notification('error', result.message);
    })
}