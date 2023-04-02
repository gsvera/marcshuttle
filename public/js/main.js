
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function(){
    // $('#typetransfer').change(function(){
        
    // });
})


function HidenShowInputs()
{
    var typetransfer = $('#typetransfer').val()
console.log(typetransfer)
    if(typetransfer == 1)
    {
        $('#divdestination').removeClass("d-none")
        $('#divorigin').addClass("d-none")
        $('#divarrival').removeClass("d-none")
        $('#divdeparture').addClass("d-none")
    }
    if(typetransfer == 2)
    {
        $('#divdestination').addClass("d-none")
        $('#divorigin').removeClass("d-none")
        $('#divarrival').addClass("d-none")
        $('#divdeparture').removeClass("d-none")
    }
    if(typetransfer == 3)
    {
        $('#divdestination').removeClass("d-none")
        $('#divorigin').removeClass("d-none")
        $('#divarrival').addClass("d-none")
        $('#divdeparture').removeClass("d-none")
    }
    if(typetransfer == 4)
    {
        $('#divdestination').removeClass("d-none")
        $('#divorigin').addClass("d-none")
        $('#divarrival').removeClass("d-none")
        $('#divdeparture').removeClass("d-none")
    }
}

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