$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function NewUser(){
    var usuario = {
        first_name: $('#firstName').val(),
        last_name: $('#lastName').val(),
        email: $('#email').val(),
        password: $('#password').val()
    }

    activeLoader('Guardando','Guardando datos')

    $.ajax({
        url: '/admin-marchshuttle/create-user',
        type: 'POST',
        data: {
            usuario: JSON.stringify(usuario)
        },
        success: function(data)
        {
            console.log(data)
            closeAlert()
            setTimeout(function(){
                if(data.Error == false)
                    successAlert('Hecho', 'Registro guardado')                                                
                else
                    errorAlert("Error", data.Message);
                
                
            },10)
        },
        error: function(xhr, status, error){
            console.log(xhr);
            console.log(status)
            console.log(error)
        }
    })
}