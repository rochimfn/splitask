@extends('layouts.form')

@section('content')

    <div class="card col-md-4 text-light py-3" style="width: 18rem;">
        <!-- <div class="card-header text-center"> -->
            <br>
            <h3 class="text-center">{{ __('Login') }}</h3>
            <hr>
        <!-- </div> -->
        <br>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
            <!-- <label for="user_name" class="col-md-4 col-form-label">{{ __('Username') }}</label> -->

                <div class="col-md-8 mx-auto">
                    <input id="user_name" type="text" placeholder="Username" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="username" autofocus>

                    @error('user_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
            <!-- <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label> -->

                <div class="col-md-8 mx-auto">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block mx-auto">
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
@endsection
