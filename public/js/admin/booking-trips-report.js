function searchBookingsTripReports() {
    var dataArrivalStart = $('#dataArrivalStart').val();
    var dataArrivalEnd = $('#dataArrivalEnd').val();
    var dataDepartureStart = $('#dataDepartureStart').val();
    var dataDepartureEnd = $('#dataDepartureEnd').val();
    var typeTransfer = $('#typeTransfer').val();
    var payMethod = $('#payMethod').val();

    fetch(`/admin-marcshuttle/get-bookings-trip-report?dataArrivalStart=${dataArrivalStart}&dataArrivalEnd=${dataArrivalEnd}&dataDepartureStart=${dataDepartureStart}&dataDepartureEnd=${dataDepartureEnd}&typeTransfer=${typeTransfer}&payMethod=${payMethod}`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            
            table.clear().draw();
            result.data.map(item => {
                var element = [
                    [
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
                        convertCurrency(item.amount)
                    ]
                ];
                table.rows.add(element).draw();
            });

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

    searchBookingsTripReports();

})

