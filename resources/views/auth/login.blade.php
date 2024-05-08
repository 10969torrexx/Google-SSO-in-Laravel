@extends('layouts.app')
@section('title', 'Login | Comprehensive Enrolment System ')
@section('content')
<div class="container">
    <div class="center-screen">
        <div class="card shadow-sm">
           
            <div class="card-body">
                <div class="row justify-content-center mb-3" id="favicon-here" >
                    <!-- Favicon will be inserted here -->
                    <img src="{{ asset('slsu_logo.png') }}" style="width: 200px;" class="mb-3">
                    <h4 class="text-center">Welcome to CES!</h4>
                </div>
                <div class="mt-2 text-center">
                    <div id="g_id_onload"
                        data-client_id="{{ env('GOOGLE_CLIENT_ID') }}"
                        data-callback="onSignIn">
                    </div>
                     <div class="g_id_signin form-control" data-type="standard"></div>
                </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
      function decodeJwtResponse(token) {
        let base64Url = token.split('.')[1]
        let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload)
    }

      window.onSignIn = googleUser => {

        var user = decodeJwtResponse(googleUser.credential);

        if(user){
          // signOut();
          $.ajax({
              url: '/auth/sso',
              method: 'post',
              data: {email : user.email},
              beforeSend:function(){},
              success:function(response){
                console.log(response);
              }
          });
        }else{
          $("#loginmsg").html("<div class = 'alert alert-danger'>You have no institutional account registered.</div>");
        }
      }
</script>

@endsection
