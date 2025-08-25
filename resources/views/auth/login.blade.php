<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin1/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/admin1/assets/img/favicon.png')}}">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/admin1/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/admin1/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/admin1/assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" 
         style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                    {{ isset($url) ? ucwords($url) : "" }} Login
                  </h4>
                </div>
              </div>
              <div class="card-body">
                {{-- Laravel Login Form --}}
                @isset($url)
                  <form method="POST" action='{{ url("login/$url") }}'>
                @else
                  <form method="POST" action="{{ route('login') }}">
                @endisset
                  @csrf

                  <!-- Email -->
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                      <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <!-- Password -->
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" required>
                    @error('password')
                      <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <!-- Remember Me -->
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label mb-0 ms-3" for="remember">
                      Remember me
                    </label>
                  </div>

                  <!-- Submit -->
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                      Login
                    </button>
                  </div>

                  <!-- Forgot password -->
                  @if (Route::has('password.request'))
                    <p class="text-sm text-center">
                      <a class="text-primary text-gradient font-weight-bold" href="{{ route('password.request') }}">
                        Forgot Your Password?
                      </a>
                    </p>
                  @endif

                </form>
                <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="{{url('/register')}}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="/assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>