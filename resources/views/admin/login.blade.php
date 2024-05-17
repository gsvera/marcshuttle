<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="bg-admin-login">
    <section id="" class="col-11 mx-auto mt-5">
      <div class="row d-flex justify-content-center">
        <div class="col-6">
          <div class="" style="border-radius: 1rem;background-color:transparent;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-6 bg-logo-back align-center row">
                <img src="/img/logos/Logo-Marcshuttle.webp" alt="login form" class="img-fluid" style="width:80%">
              </div>
              <div class="col-md-6 col-lg-6 bg-white d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center mb-3 pb-1">
                      <span class="fsize-sm font-weight-bold mb-0">Login</span>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17" style="margin-left: 0px;">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}">
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27" style="margin-left: 0px;">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-lg btn-success" style="width:100%;" type="submit">Login</button>
                    </div>
                    <div class="text-center">
                      <a class="small text-muted" href="{{route('forget-password')}}">¿Olvido su contraseña?</a>
                    </div>
                    @if(session('message'))
                      <div class="alert alert-danger">{{session('message')}}</div>
                    @endif
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>
</html>