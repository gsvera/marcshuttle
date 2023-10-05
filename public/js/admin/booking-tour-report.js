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