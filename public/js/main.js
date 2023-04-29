
const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i


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