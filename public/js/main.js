
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})



function changeLenguage(lang){
    console.log(lang)
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
                window.location.reload()
            }
        }
    })
}