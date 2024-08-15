<div class="mx-3 mt-3 mb-1">
    <div>
        <h4>Bookings Trip</h4>
    </div>
    <div class="d-flex">
        <div class="col-3">
            <div class="card shadow mb-4">
                <a href="#collapseDateArrival" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseDateArrival">
                    <h6 class="m-0 font-weight-bold text-primary">Fecha de llegada</h6>
                </a>
                <div class="collapse" id="collapseDateArrival">
                    <div class="card-body px-0">
                        <div class="d-flex">
                            <div class="col-6">
                                <div class="text-center">
                                    <label for="dataArrivalStart" class="text-secondary">Inicio</label>
                                </div>
                                <input type="date" class="form-control" name="dataArrivalStart" id="dataArrivalStart" onchange="searchBookingsTripReports()" />
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <label for="dataArrivalEnd" class="text-secondary">Fin</label>
                                </div>
                                <input type="date" class="form-control" name="dataArrivalEnd" id="dataArrivalEnd" onchange="searchBookingsTripReports()" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow mb-4">
                <a href="#collapseDateDeparture" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseDateDeparture">
                    <h6 class="m-0 font-weight-bold text-primary">Fecha de Salida</h6>
                </a>
                <div class="collapse" id="collapseDateDeparture">
                    <div class="card-body px-0">
                        <div class="d-flex">
                            <div class="col-6">
                                <div class="text-center">
                                    <label for="dataDepartureStart" class="text-secondary">Inicio</label>
                                </div>
                                <input type="date" class="form-control" name="dataDepartureStart" id="dataDepartureStart" onchange="searchBookingsTripReports()" />
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <label for="dataDepartureEnd" class="text-secondary">Fin</label>
                                </div>
                                <input type="date" class="form-control" name="dataDepartureEnd" id="dataDepartureEnd" onchange="searchBookingsTripReports()" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow mb-4">
                <a href="#collapseTypeTransfer" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseTypeTransfer">
                    <h6 class="m-0 font-weight-bold text-primary">Tipo de transfer</h6>
                </a>
                <div class="collapse" id="collapseTypeTransfer">
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" name="typeTransfer" id="typeTransfer" onchange="searchBookingsTripReports()">
                                <option value="0" selected>Seleccione una opcion</option>
                                <option value="1">AL Hotel</option>
                                <option value="2">Al Aeropuerto</option>
                                <option value="3">Viaje redondo</option>
                                <option value="4">Viaje personalizado</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow mb-4">
                <a href="#collapsePayMethod" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapsePayMethod">
                    <h6 class="m-0 font-weight-bold text-primary">Metodo de pago</h6>
                </a>
                <div class="collapse" id="collapsePayMethod">
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" name="payMethod" id="payMethod" onchange="searchBookingsTripReports()">
                                <option value="0" selected>Seleccione una opcion</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="card">Tarjeta</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="p-3 mx-5 mb-5 table-admin-report">
    <div class="table-responsive table-hover">
        <table id="tableReport" class="table table-striped" cellspacing="0" style="width:100%">
            <thead class="">
                <tr>
                    <th></th>
                    <th></th>
                    <th scope="col">Folio</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Fecha llegada</th>
                    <th scope="col">Fecha Salida</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Origen</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Pasajeros</th>
                    <th scope="col">Metodo de pago</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Payer Id</th>
                    <th scope="col">Payment Id</th>
                    <th scope="col">Cupon</th>
                    <th scope="col">Monto cupon</th>
                    <th scope="col">Monto</th>
                </tr>
            </thead>
            <tbody id="bodyTable">

            </tbody>
        </table>
    </div>
</div>

 <!-- Logout Modal-->
 <div class="modal fade" id="resendEmailModal" tabindex="-1" role="dialog" aria-labelledby="resendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resendEmailModalLabel">Reenvio de reservacion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idReservationTrip" name="idReservationTrip" />
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="text" name="emailResendTrip" id="emailResendTrip">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" onclick="resendEmailTrip()">Enviar correo</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin/booking-trips-report.js')}}"></script>
