<div class="mx-5 my-3">
    <div class="d-flex justify-content-between my-3">
        <div>
            <h4>Vehiculos</h4>
        </div>
        <div>
            <button class="btn btn-success" onClick="showModalVehicle()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar vehiculo</button>
        </div>
    </div>
    <div>
    <div id="content-group-vehicle" class="row"></div>        

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalVehicle" tabindex="-1" aria-labelledby="modalVehicleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="modalVehicleLabel">Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="form-vehicle">
        <input type="hidden" name="idVehicle" id="idVehicle">
        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="nameVehicle" style="margin-left: 0px;">Nombre del vehiculo*</label>
            <input type="text" name="nameVehicle" id="nameVehicle" class="form-control required">
        </div>

        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="minPax" style="margin-left: 0px;">Minimo de pasajeros*</label>
            <input name="minPax" id="minPax" type="number" class="form-control required"/>
        </div>
        
        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="maxPax" style="margin-left: 0px;">Maximo de pasajeros*</label>
            <input name="maxPax" id="maxPax" type="number" class="form-control required" />
        </div>

        <div class="form-outlin mb-4">
          <div id="content-img-card">
            <img id="img-vehicle" style="width:100%; height:100%"/>
          </div>
          <div class="form-group">
            <label class="font-weight-bold text-secondary" for="imgVehicleFile">Imagen de vehiculo</label>
            <input class="form-control" type="file" accept=".png, .jpg, .webp" name="imgVehicleFile" id="imgVehicleFile"/>
          </div>
        </div>
        
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-save-vehicle"  disabled >Guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/admin/vehicles.js') }}"></script>