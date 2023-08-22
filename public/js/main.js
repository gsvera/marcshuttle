
const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
const headConexion = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': window.CSRF_TOKEN //the token is create in head html
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function changeLenguage(lang){
    var prefij = ''
    if(lang == 'en')
        prefij = 'en'

    $.ajax({
        url: '/changelenguage',
        type: "POST",
        data: {
            "lang": lang
        },
        success: function(result)
        {
            if(result.error == false)
            {
                window.location.href = '/'+prefij
            }
        }
    })
}

function convertCurrency(n){
    let currencyLocal = Intl.NumberFormat('en-US',{style:'currency', currency:'USD'})
    
    return (currencyLocal.format(n))
    
  }