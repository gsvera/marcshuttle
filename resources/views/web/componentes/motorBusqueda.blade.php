<div class="d-flex justify-content-center">
    <div class="box-buscador col-md-9">
        <h3 class="text-white font-weight-bold">{{__('MotorBusqueda.slogan')}}</h3>
        <p class="text-white">{{__('MotorBusqueda.texto-1')}}</p>
        <div class="mt-4">
            <div class="form-group mb-3">
                <label for="typetransfer" class="font-weight-bold">{{__('MotorBusqueda.type-transfer')}}</label>
                <select class="form-select p-3" name="typetransfer" id="typetransfer" onchange="HidenShowInputs()">
                        <option value="1">{{__('MotorBusqueda.aeropuerto-hotel')}}</option>
                        <option value="2">{{__('MotorBusqueda.hotel-aeropuerto')}}</option>
                        <option value="3">{{__('MotorBusqueda.hotel-hotel')}}</option>
                        <option value="4">{{__('MotorBusqueda.redondo-aeropuerto')}}</option>
                </select> 
            </div>
            <div class="from-group mb-3 d-none" id="divorigin">
                <label for="origin" class="font-weight-bold">{{__('MotorBusqueda.origen')}}</label>
                <input type="text" class="form-control p-3" name="origin" id="origin" placeholder="origen"/>
            </div>
            <div class="from-group mb-3" id="divdestination">
                <label for="destination" class="font-weight-bold">{{__('MotorBusqueda.destino')}}</label>
                <input type="text" class="form-control p-3" name="destination" id="destination" placeholder="destino"/>
            </div>
            <div class="form-group mb-3">
                <label for="pax" class="font-weight-bold">{{__('MotorBusqueda.pasajeros')}}</label>
                <input type="number" class="form-control p-3" value='1' name="pax" id="pax"/>
            </div>
            <div class="d-flex justify-content-between mb-3" id="divarrival">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date-reserve" class="font-weight-bold">{{__('MotorBusqueda.fecha-llegada')}}</label>
                        <input class="form-control p-3" type="date" name="date-reserve" id="date-reserve">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="time-reserve" class="font-weight-bold">{{__('MotorBusqueda.hora')}}</label>
                        <input class="form-control p-3" type="time" name="time-reserve" id="time-reserve">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3 d-none" id="divdeparture">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date-reserve" class="font-weight-bold">{{__('MotorBusqueda.fecha-salida')}}</label>
                        <input class="form-control p-3" type="date" name="date-reserve" id="date-reserve">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="time-reserve" class="font-weight-bold">{{__('MotorBusqueda.hora')}}</label>
                        <input class="form-control p-3" type="time" name="time-reserve" id="time-reserve">
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-naranja btn-lg">{{__('MotorBusqueda.boton-buscar')}}</button>
            </div>
        </div>
    </div>
</div>
