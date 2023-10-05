<div class="mx-5 mt-3 mb-5">
    <div>
        <h4>Tours</h4>
    </div>
    <div class="d-flex justify-content-between">
        <div class="input-group mb-3 col-4 col-sm-6 col-md-5">
            <input type="text" class="form-control" id="search-tour" placeholder="Buscar por nombre"  aria-describedby="searchTour">
            <div class="input-group-append">
                <button class="btn btn-secondary input-group-text" onclick="fireSearchTour()">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-success" onclick="openModalTour()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar tour</button>
        </div>
    </div>    
    <div id="content-group-tour" class="row"></div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalTours" tabindex="-1" aria-labelledby="modalToursLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="modalToursLabel">Tour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="form-tour">
        <input type="hidden" name="idTour" id="idTour">
        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="nameTour" style="margin-left: 0px;">Nombre Tour*</label>
            <input type="text" name="nameTour" id="nameTour" class="form-control required">
        </div>

        <div class="form-outlin mb-4">
          <div id="content-img-card">
            <img id="img-tour" style="width:100%; height:100%"/>
          </div>
          <div class="form-group">
            <label class="font-weight-bold text-secondary" for="imgTourFile">Imagen de tour</label>
            <input class="form-control" type="file" accept=".png, .jpg, .webp" name="imgTourFile" id="imgTourFile"/>
          </div>
        </div>

        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="descriptionEs" style="margin-left: 0px;">Descripcion en español*</label>
            <textarea name="descriptionEs" id="descriptionEs" cols="30" rows="5" class="form-control required"></textarea>            
        </div>

        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="descriptionEn" style="margin-left: 0px;">Descripcion en ingles*</label>
            <textarea name="descriptionEn" id="descriptionEn" cols="30" rows="5" class="form-control required"></textarea>            
        </div>
        
        <div id="content-vehicles-form"></div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-save-tour"  disabled >Guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/admin/tour.js') }}"></script>