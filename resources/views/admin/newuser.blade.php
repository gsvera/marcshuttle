    <section id="" class="col-11 mx-auto mt-5">
      <div class="row d-flex justify-content-center">
        <div class="col-6">
          <div class="" style="border-radius: 1rem;background-color:white;">
            <div class="row g-0">
              <div class="d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <div>
                    @csrf

                    <div class="form-outline mb-4">
                        <label class="form-label" for="firstName" style="margin-left: 0px;">Nombres</label>
                        <input type="text" name="firstName" id="firstName" class="form-control form-control-lg" value="{{ old('firstName') }}">
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="lastName" style="margin-left: 0px;">Apellidos</label>
                        <input type="text" name="lastName" id="lastName" class="form-control form-control-lg" value="{{ old('email') }}">
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="email" style="margin-left: 0px;">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') }}">
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password" style="margin-left: 0px;">Contraseña</label>
                        <input type="text" name="password" id="password" class="form-control form-control-lg">
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-lg btn-success" onclick="NewUser()" style="width:100%;" type="button">Login</button>
                    </div>
                                        
                  </d>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>