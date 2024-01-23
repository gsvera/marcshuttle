<?php
    use App\Models\Utils;
?>

<div class="mx-5 mt-3 mb-5">
    <div>
        <h4>Zonas</h4>
    </div>
    <div class="d-flex justify-content-between">
        <div class="input-group mb-3 col-4 col-sm-6 col-md-5">
            <input type="text" class="form-control" id="search-zona" placeholder="Buscar por nombre"  aria-describedby="searchZona">
            <div class="input-group-append">
                <button class="btn btn-secondary input-group-text" onclick="fireSearchZone()">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.AGREGAR_ZONAS')))
        <div>
            <button type="button" class="btn btn-success" onclick="openModalAdd()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar zona</button>
        </div>
        @endif
    </div>    
    <table class="table mb-0">
        <thead class="thead-dark">
            <tr>
                <th class="col-2"></th>
                <th class="col-2"></th>
                <th class="col-6 text-center">PRECIOS POR PASAJEROS</th>
                <th></th>
                <th class="col-2"></th>
            </tr>
        </thead>
    </table>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="col-4">Nombre</th>
                <th class="col-2 text-center">Uno a Tres</th>
                <th class="col-2 text-center">Cuatro a Siete</th>
                <th class="col-2 text-center">Ocho a Diez</th>
                <th class="col-2 text-center">Editar</th>
            </tr>
        </thead>
        <tbody id="table-body-zona">
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalZona" tabindex="-1" aria-labelledby="modalZonaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalZonaLabel">Administrar zonas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="form-zona">
        <input type="hidden" name="idZona" id="idZona">
        <div class="form-outline mb-4">
            <label class="form-label font-weight-bold" for="nameZona" style="margin-left: 0px;">Nombre</label>
            <input type="text" name="nameZona" id="nameZona" class="form-control required">
        </div>
        <p class="text-center font-weight-bold text-secondary">Precios</p>
        <hr>
        <div class="form-group row mb-4">
            <label class="col-form-label col-sm-5 font-weight-bold" for="unoTres" style="margin-left: 0px;">Uno a tres</label>
            <div class="col-sm-7">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i></div>
                    </div>
                    <input type="text" name="unoTres" id="unoTres" class="form-control required required-price" onchange="acceptOnlyPrice(this.value)">
                </div>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label col-sm-5 font-weight-bold" for="cuatroSiete" style="margin-left: 0px;">Cuatro a siete</label>
            <div class="col-sm-7">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i></div>
                    </div>
                    <input type="text" name="cuatroSiete" id="cuatroSiete" class="form-control required required-price" onchange="acceptOnlyPrice(this.value)">
                </div>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label col-sm-5 font-weight-bold" for="ochoDiez" style="margin-left: 0px;">Ocho a diez</label>
            <div class="col-sm-7">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i></div>
                    </div>
                    <input type="text" name="ochoDiez" id="ochoDiez" class="form-control required required-price" onchange="acceptOnlyPrice(this.value)">
                </div>
            </div>
        </div>

      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-save-zona" disabled >Guardar</button>
      </div>
    </div>
  </div>
</div>




<script src="{{ asset('js/admin/zona.js') }}"></script>