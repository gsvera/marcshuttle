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

<!-- 
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 157.406px;">Name</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 259.328px;">Position</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 111.578px;">Office</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 48.7188px;">Age</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 105.156px;">Start date</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 93.8125px;">Salary</th></tr>
                                    </thead>
                                    <tfoot>
                                        <tr><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Position</th><th rowspan="1" colspan="1">Office</th><th rowspan="1" colspan="1">Age</th><th rowspan="1" colspan="1">Start date</th><th rowspan="1" colspan="1">Salary</th></tr>
                                    </tfoot>
                                    <tbody>
                                      
                                    <tr class="odd">
                                            <td class="sorting_1">Gloria Little</td>
                                            <td>Systems Administrator</td>
                                            <td>New York</td>
                                            <td>59</td>
                                            <td>2009/04/10</td>
                                            <td>$237,500</td>
                                        </tr><tr class="even">
                                            <td class="sorting_1">Haley Kennedy</td>
                                            <td>Senior Marketing Designer</td>
                                            <td>London</td>
                                            <td>43</td>
                                            <td>2012/12/18</td>
                                            <td>$313,500</td>
                                        </tr><tr class="odd">
                                            <td class="sorting_1">Hermione Butler</td>
                                            <td>Regional Director</td>
                                            <td>London</td>
                                            <td>47</td>
                                            <td>2011/03/21</td>
                                            <td>$356,250</td>
                                        </tr><tr class="even">
                                            <td class="sorting_1">Herrod Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>59</td>
                                            <td>2012/08/06</td>
                                            <td>$137,500</td>
                                        </tr><tr class="odd">
                                            <td class="sorting_1">Hope Fuentes</td>
                                            <td>Secretary</td>
                                            <td>San Francisco</td>
                                            <td>41</td>
                                            <td>2010/02/12</td>
                                            <td>$109,850</td>
                                        </tr><tr class="even">
                                            <td class="sorting_1">Howard Hatfield</td>
                                            <td>Office Manager</td>
                                            <td>San Francisco</td>
                                            <td>51</td>
                                            <td>2008/12/16</td>
                                            <td>$164,500</td>
                                        </tr><tr class="odd">
                                            <td class="sorting_1">Jackson Bradshaw</td>
                                            <td>Director</td>
                                            <td>New York</td>
                                            <td>65</td>
                                            <td>2008/09/26</td>
                                            <td>$645,750</td>
                                        </tr><tr class="even">
                                            <td class="sorting_1">Jena Gaines</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>30</td>
                                            <td>2008/12/19</td>
                                            <td>$90,560</td>
                                        </tr><tr class="odd">
                                            <td class="sorting_1">Jenette Caldwell</td>
                                            <td>Development Lead</td>
                                            <td>New York</td>
                                            <td>30</td>
                                            <td>2011/09/03</td>
                                            <td>$345,000</td>
                                        </tr><tr class="even">
                                            <td class="sorting_1">Jennifer Acosta</td>
                                            <td>Junior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>43</td>
                                            <td>2013/02/01</td>
                                            <td>$75,650</td>
                                        </tr></tbody>
                                </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 21 to 30 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                            </div>
                        </div>
                    </div> -->