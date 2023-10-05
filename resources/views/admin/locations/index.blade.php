<div class="mx-5 mt-3 mb-5">
    <div>
        <h4>Hotel / airbnb por zonas</h4>
    </div>
    <div class="input-group mb-3 col-4 col-sm-6 col-md-5 p-0">
        <input type="text" class="form-control" id="search-zona-locations" placeholder="Buscar por zona"  aria-describedby="searchZona">
        <div class="input-group-append">
            <button class="btn btn-secondary input-group-text" onclick="searchZoneLocations()">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div id="content-group-zonas" class="row"></div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalLocations" tabindex="-1" aria-labelledby="modalLocationsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLocationsLabel">Administrar hotel / airbnb / ubicaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="form-user">
        <input type="hidden" name="idZona" id="idZona">
        <p><span class="font-weight-bold">Zona:</span> <span id="nameZonaLabel"></span></p>
        <div class="form-group">
            <hr>
            <p class="text-center text-secondary font-weight-bold">Locaciones</p>
            <div class="d-flex">
              <div class="col-10 p-0">
                <input type="text" class="form-control" name="newUbication" id="newUbication">
              </div>
              <div class="col-1">
                <button type="button" class="btn btn-success" onclick="addZona()"><i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>
            </div>
            <div class="scroll-div" id="contentLocaciones"></div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script src="{{ asset('js/admin/locations.js') }}"></script>
