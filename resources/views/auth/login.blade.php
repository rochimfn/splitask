@extends('layouts.app')

@section('content')
<div class="container" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/91.jpg'); background-repeat: no-repeat; background-position: center center; opacity: 0.7">
    <div class="row justify-content-center rgba-gradient">
        <div class="col-md-6" >
            <div class="card shadow bg-transparent">
                    <div class="card-header border-bottom text-light">
                        <h3>{{ __('Login') }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <!-- <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label> -->

                                <div class="col-md-8 mx-auto">
                                    <input id="user_name" type="text" placeholder="Username" class="form-control @error('user_name') is-invalid @enderror rounded-pill" name="user_name" value="{{ old('user_name') }}" required autocomplete="username" autofocus>

                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                                <div class="col-md-8 mx-auto">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror rounded-pill" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label text-light" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 mx-auto">
                                    <button type="submit" class="btn btn-outline-light btn-block rounded-pill mx-auto">
                                        {{ __('Login') }}
                                    </button>
                                    <br>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link btn-block text-center text-light" href="{{ route('password.request') }}">
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
</div>
@endsection
