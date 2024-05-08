<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="{{ asset('UI_spp/assets/logoSekolah.png') }}" />
  <link rel="stylesheet" href="{{ asset('UI_spp/bootstrap/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('UI_spp/css/login.css') }}" />
  <title>SPPS Pelita Hati</title>
</head>
<body>
  <div id="carouselExampleSlidesOnly" class="carousel slide position-absolute" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('UI_spp/assets/bg-login/bg-1.jpg') }}" class="d-block w-100" alt="Background 1" />
      </div>
      <div class="carousel-item">
        <img src="{{ asset('UI_spp/assets/bg-login/bg-2.jpg') }}" class="d-block w-100" alt="Background 2" />
      </div>
      <div class="carousel-item">
        <img src="{{ asset('UI_spp/assets/bg-login/bg-3.jpg') }}" class="d-block w-100" alt="Background 3" />
      </div>
    </div>
  </div>

  <div class="main-content">
    <span class="name">SEKOLAH DASAR KRISTEN<br />PELITA HATI</span>
    <div class="form-login">
      <span class="login-header">LOGIN USER</span>
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <form action="{{ route('login-proses') }}" method="POST">
          @csrf
          <div class="main-login">
              <div class="main-section">
                  <span class="input-span">Username :</span>
                  <input class="input" value="{{ old('username') }}" type="text" name="username"
                      placeholder="Masukkan username" />
              </div>
              <div class="main-section">
                  <span class="input-span">Password :</span>
                  <input id="password" class="input" type="password" name="password" placeholder="Masukkan password" />
                  <div class="con-hide">
                      <img id="hide" src="{{ asset('UI_spp/assets/icons/eye.svg') }}" class="hide" alt="unhide" />
                  </div>
              </div>
              <button type="submit" id="masuk" class="btn btn-success">Masuk</button>
              <div class="hub-admin d-flex justify-content-center">
                  <span class="d-inline pe-2">Belum punya akun?</span>
                  <a href="#" class="d-inline fw-bold">Hubungi admin</a>
              </div>
          </div>
      </form>
  </div>
  
  </div>

  <script src="{{ asset('UI_spp/bootstrap/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ asset('UI_spp/js/login.js') }}"></script>
</body>
</html>
