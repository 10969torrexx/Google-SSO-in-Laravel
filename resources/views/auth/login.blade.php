@extends('layouts.app')
@section('title', 'Login | Human Resources Mangement System')
@section('content')
<div class="container">
    <div class="center-screen">
        <div class="card shadow-sm">
           
            <div class="card-body">
                <div class="row justify-content-center mb-3" id="favicon-here" >
                    <!-- Favicon will be inserted here -->
                    <img src="{{ asset('slsu_logo.png') }}" style="width: 200px;" class="mb-3">
                    <h4 class="text-center">Welcome to HRMS!</h4>
                </div>
                <div class="mt-2 text-center">
                    <div id="g_id_onload" data-client_id="{{env('GOOGLE_CLIENT_ID')}}" data-callback="onSignIn"></div>
                    <div class="g_id_signin form-control" data-type="standard"></div>
                </div>
                </div>
                <div class="divider"></div>
                <h4 class="text-center mb-4">or enter you account below</h4>
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


                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary col-12 mb-2">
                                {{ __('Login') }}
                            </button>
                            <a href="/register" class="btn btn-secondary col-12">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src = "https://accounts.google.com/gsi/client" async defer></script>
<script>
    function decodeJwtResponse(token){
       let base64url = token.split('.')[1];
       let base64 = base64url.replace(/-/g, '+').replace(/_/g, '/');
       let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) { 
           return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
       }).join(''));
       return JSON.parse(jsonPayload);
    }
   
    window.onSignIn = googleUser =>{
       var user = decodeJwtResponse(googleUser.credential);
        if(user){
            $.ajaxSetup({
                headers: {  'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
               url: `{{ route('loginGoogle') }}`,
               method: 'POST',
               data: {
                email: user.email,
                name: user.name
            },
               beforeSend: function(){
                   $('#btnLogin').html("REDIRECTING...").prop("disabled", true);
               },
               success:function(response){
                console.log(response);
               },
               error:function(xhr, status, error){
                 alert(xhr.responseJSON.message);
               }
            });
        }
    }
   </script>

@endsection
