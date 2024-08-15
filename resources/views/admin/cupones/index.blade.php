
<div class="mx-5 mt-3 mb-5">
    <div class="d-flex justify-content-between my-3">
        <div>
            <h4>Cupones</h4>
        </div>
        <div>
            <button class="btn btn-success" onClick="showModalCupones()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar cupon</button>
        </div>
    </div>
    <div>
        <div id="content-group-cupones" class="row"></div>
    </div>
</div>

<div class="modal fade" id="modalCupones" tabindex="-1" aria-labelledby="modalCuponesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="modalCuponesLabel">Cupones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" id="form-cupon">
                <input type="hidden" name="idCupon" id="idCupon">
                <div class="form-outline mb-4">
                    <label class="font-weight-bold text-secondary" for="cupon" style="margin-left: 0px;">Clave de cupon*</label>
                    <input type="text" name="cupon" id="cupon" class="form-control required">
                </div>
                <div class="form-outline mb-4">
                    <label class="font-weight-bold text-secondary" for="amount" style="margin-left: 0px;">Monto de descuento*</label>
                    <input type="number" min="1" name="amount" id="amount" class="form-control required">
                </div>
                <div class="form-outline mb-4">
                    <label class="font-weight-bold text-secondary" for="count" style="margin-left: 0px;">Cantidad de cupones*</label>
                    <input type="number" min="1" name="count" id="count" class="form-control required">
                </div>
                <div class="form-outline mb-4">
                    <label class="font-weight-bold text-secondary" for="expirationDate" style="margin-left: 0px;">Fecha de expiración*</label>
                    <input type="date" name="expirationDate" id="expirationDate" class="form-control required" onclick="handleShowPicker(this)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-save-cupon" disabled >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin/cupones.js') }}"></script>