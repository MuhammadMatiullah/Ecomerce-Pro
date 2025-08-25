@extends('layouts.app')

@section('content')
<main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <!-- Left Side Illustration -->
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute 
                        top-0 start-0 text-center justify-content-center flex-column">
             <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg 
            d-flex flex-column justify-content-center" 
     style="background-image: url('{{ asset('assets/admin1/assets/img/illustrations/illustration-signup.jpg') }}'); 
            background-size: cover;">
</div>

            </div>

            <!-- Register Form -->
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Register</h4>
                  <p class="mb-0">Enter your details to create your account</p>
                </div>

                <div class="card-body">
                  @isset($url)
                  <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                  @else
                  <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                  @endisset
                    @csrf

                    <!-- Name -->
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Name</label>
                      <input id="name" type="text" 
                             class="form-control @error('name') is-invalid @enderror" 
                             name="name" value="{{ old('name') }}" required autofocus>
                      @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <!-- Email -->
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input id="email" type="email" 
                             class="form-control @error('email') is-invalid @enderror" 
                             name="email" value="{{ old('email') }}" required>
                      @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <!-- Password -->
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input id="password" type="password" 
                             class="form-control @error('password') is-invalid @enderror" 
                             name="password" required autocomplete="new-password">
                      @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Confirm Password</label>
                      <input id="password-confirm" type="password" 
                             class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">
                        {{ __('Register') }}
                      </button>
                    </div>
                  </form>
                </div>

                <!-- Footer -->
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
@endsection
