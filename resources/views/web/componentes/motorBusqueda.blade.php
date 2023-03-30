<div class="d-flex justify-content-center">
    <div class="box-buscador col-md-9">
        <h3 class="text-white font-weight-bold">{{__('MotorBusqueda.slogan')}}</h3>
        <p class="text-white">{{__('MotorBusqueda.texto-1')}}</p>
        <div class="mt-4">
            <div class="form-group">
                <label for="typetransfer" class="font-weight-bold">{{__('MotorBusqueda.type-transfer')}}</label>
                <select class="form-select p-3 my-3" name="typetransfer" id="typetransfer">
                        <option value="2">{{__('MotorBusqueda.aeropuerto-hotel')}}</option>
                        <option value="1">{{__('MotorBusqueda.hotel-aeropuerto')}}</option>
                        <option value="3">{{__('MotorBusqueda.hotel-hotel')}}</option>
                        <option value="4">{{__('MotorBusqueda.redondo-aeropuerto')}}</option>
                </select> 
            </div>
            <select class="form-select p-3 my-3" name="" id="">
                <option value="ubicacion">ubicacion</option>
            </select>
            <input type="number" class="form-control p-3 my-3" value='1' />
            <div class="d-flex justify-content-between my-3">
                <div class="col-md-6">
                    <input class="form-control p-3" type="date" name="" id="" placeholder="{{__('MotorBusqueda.fecha-llegada')}}">
                </div>
                <div class="col-md-5">
                    <input class="form-control p-3" type="time" name="" id="" placeholder="{{__('MotorBusqueda.hora')}}">
                </div>
            </div>
            <div class="d-flex justify-content-between my-3">
                <div class="col-md-6">
                    <input class="form-control p-3" type="date" name="" id="" placeholder="{{__('MotorBusqueda.fecha-salida')}}">
                </div>
                <div class="col-md-5">
                    <input class="form-control p-3" type="time" name="" id="" placeholder="{{__('MotorBusqueda.hora')}}">
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-naranja btn-lg">{{__('MotorBusqueda.boton-buscar')}}</button>
            </div>
        </div>
    </div>
</div>
