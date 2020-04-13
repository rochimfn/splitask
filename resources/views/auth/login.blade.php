@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" >
            <div class="card shadow img-fluid">
                <img class="card-img-top rounded" src="https://images.unsplash.com/photo-1557683325-3ba8f0df79de?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80" alt="Login" style="height:400px">
                <div class="card-img-overlay">
                    <div class="card-header border-bottom text-light bg-transparent">
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
</div>
@endsection
