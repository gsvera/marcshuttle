function searchBookingsTripReports() {
    var dataArrivalStart = $('#dataArrivalStart').val();
    var dataArrivalEnd = $('#dataArrivalEnd').val();
    var dataDepartureStart = $('#dataDepartureStart').val();
    var dataDepartureEnd = $('#dataDepartureEnd').val();
    var typeTransfer = $('#typeTransfer').val();
    var payMethod = $('#payMethod').val();

    activeLoader('Cargando...', 'Cargando datos');

    fetch(`/admin-marcshuttle/get-bookings-trip-report?dataArrivalStart=${dataArrivalStart}&dataArrivalEnd=${dataArrivalEnd}&dataDepartureStart=${dataDepartureStart}&dataDepartureEnd=${dataDepartureEnd}&typeTransfer=${typeTransfer}&payMethod=${payMethod}`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            table.clear().draw();
            result.data.map(item => {
                var element = [
                    [
                        `<button class="btn btn-outline-primary" onclick="modalSendEmail(${item.id}, '${item.email}')"><i class="fa fa-envelope" aria-hidden="true"></i></button>`,
                        `<button class="btn btn-outline-primary" onclick="modalDownloadPdf('${item.folio}')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>`,
                        item.folio,
                        item.first_name +' '+ item.last_name,
                        item.email, item.phone,
                        item.arrival_date ?? "",
                        item?.departure_date ?? "",
                        item.name_type_transfer,
                        item.origin,
                        item.destination,
                        item.pax,
                        item.pay_method,
                        item.order_id == '0' ? '' : item.order_id,
                        item.payer_id,
                        item.payment_id,
                        convertCurrency(item.amount)
                    ]
                ];
                table.rows.add(element).draw();
            });
        }
        closeAlert();
    })
}

var table = new DataTable('#tableReport', {
    pageLength: 10,
    scrollY: 400,
    scrollX: true,
    autoWidth: false
});

$(document).ready(() => {

    searchBookingsTripReports();

})

function modalSendEmail(idTrip, email) {
    $('#idReservationTrip').val(idTrip);
    $('#emailResendTrip').val(email);
    $('#resendEmailModal').modal('show');
}

function modalDownloadPdf(folio) {
    $.getScript('/js/admin/downloadPDF.js', function() {
        downloadPDF(folio);
    });
}

function resendEmailTrip() {
    if(!regex.test($('#emailResendTrip').val())) {
        notification('error', 'Ingrese un email valido')
        return false
    }

    var obj = {
        idReservation: $('#idReservationTrip').val(),
        email: $('#emailResendTrip').val()
    };

    activeLoader('Reenviando...', 'Se esta enviando nuevamente el email de confirmación');

    fetch('/admin-marcshuttle/resend-email-trip', {
        method: 'POST',
        headers: headConexion,
        body: JSON.stringify(obj)
    })
    .then(res => res.json())
    .then(result => {
        closeAlert();
        if(result.error == false) {
            notification('success', 'Se envio el email correctamente');
            $('#resendEmailModal').modal('hide');
        }
        else
            notification('error', result.message);
    })
}
