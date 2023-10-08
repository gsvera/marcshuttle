<div class="mx-5 my-3">
    <div class="d-flex justify-content-between my-3">
        <div>
            <h4>Usuarios</h4>
        </div>
        <div>
            <button class="btn btn-success" onClick="showModalUser()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar usuario</button>
        </div>
    </div>
    
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Email</th>
          <th scope="col">Estatus</th>
          <th scope="col">Editar</th>
        </tr>
      </thead>
      <tbody id="table-body-user">
        <!-- Aqui se agregan los datos dinamicamente con js  -->
      </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="modalUserLabel">Administrar usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="form-user">
        <input type="hidden" name="idUser" id="idUser">
        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="firstName" style="margin-left: 0px;">Nombres*</label>
            <input type="text" name="firstName" id="firstName" class="form-control required" value="{{ old('firstName') }}">
        </div>

        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="lastName" style="margin-left: 0px;">Apellidos*</label>
            <input type="text" name="lastName" id="lastName" class="form-control required" value="{{ old('email') }}">
        </div>

        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="email" style="margin-left: 0px;">Email*</label>
            <input type="email" name="email" id="email" class="form-control required" value="{{ old('email') }}">
        </div>
        
        
        <div class="form-outline mb-4" id="divPassword">
            <p class="text-secondary font-weight-bold">La contraseña debe contener por lo menos una mayuscula, una minuscula y un numero.</p>
            <label class="font-weight-bold text-secondary" for="password" style="margin-left: 0px;">Contraseña*</label>
            <input type="text" name="password" id="password" class="form-control required">
        </div>        

        <div class="form-outline mb-4">
            <label class="font-weight-bold text-secondary" for="profile">Perfil*</label>
            <select class="form-control required" id="profile">
                <option value="0" disabled selected>Seleccione un perfil</option>
            </select>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-save" disabled >Guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/admin/user.js') }}"></script>
