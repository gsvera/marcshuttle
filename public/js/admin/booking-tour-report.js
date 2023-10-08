function getTours() {
    var toursSelect =  document.getElementById('toursSelect');

    fetch('/admin-marcshuttle/get-tour-options')
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            result.data.map(item => {
                var option = `<option value="${item.id}">${item.name}</option>`
                toursSelect.insertAdjacentHTML('beforeend', option);
            });
        }
    })
}

function searchBookingsTourReports() {
    var dateDepartureStart = $('#dateDepartureStart').val();
    var dateDepartureEnd = $('#dateDepartureEnd').val();
    var toursSelect = $('#toursSelect').val();
    var payMethod = $('#payMethod').val();

    fetch(`/admin-marcshuttle/get-bookings-tour-report?dateDepartureStart=${dateDepartureStart}&dateDepartureEnd=${dateDepartureEnd}&toursSelect=${toursSelect}&payMethod=${payMethod}`)
    .then(res => res.json())
    .then(result => {
        console.log(result)
        if(result.error == false) {
            table.clear().draw();
            result.data.map(item => {
                var element = [
                    [
                        `<button class="btn btn-outline-primary" onclick="modalSendEmail(${item.id}, '${item.email}')"><i class="fa fa-envelope" aria-hidden="true"></i></button>`, 
                        item.folio,
                        item.first_name + ' ' + item.last_name,
                        item.email,
                        item.phone,
                        item.departure_date,
                        item.tour_name,
                        item.pay_method,
                        convertCurrency(item.amount)
                    ]
                ];
                table.rows.add(element).draw();
            })
        }
    })
}

var table = new DataTable('#tableReport', {
    pageLength: 10,
    scrollY: 400,    
    scrollX: true,
    autoWidth: false
});

$(document).ready(() => {
    getTours();
    searchBookingsTourReports();
})

function modalSendEmail(idReservation, email) {
    $('#idReservationTour').val(idReservation);
    $('#emailResendTour').val(email);
    $('#resendEmailModalTour').modal();
}

function resendEmailTour() {
    if(!regex.test($('#emailResendTour').val())) {
        notification('error', 'Ingrese un email valido')
        return false
    }

    var obj = {
        idReservation: $('#idReservationTour').val(),
        email: $('#emailResendTour').val()
    };

    activeLoader('Reenviando...', 'Se esta enviando nuevamente el email de confirmación');

    fetch('/admin-marcshuttle/resend-email-tour', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify(obj)
    })
    .then(res => res.json())
    .then(result => {
        console.log(result)
        closeAlert()
        if(result.error == false) {
            notification('success', 'Se envio el email correctamente');
            $('#resendEmailModal').modal('hide');
        }
        else
            notification('error', result.message);
    })

}