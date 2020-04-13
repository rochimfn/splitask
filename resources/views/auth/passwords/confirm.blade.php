@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow img-fluid">
            <img class="card-img-top rounded" src="https://images.unsplash.com/photo-1557683325-3ba8f0df79de?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80" alt="Login" style="height:300px">
                <div class="card-img-overlay">
                    <div class="card-header bg-dark text-white"><h3>{{ __('Confirm Password') }}</h3></div>

                    <div class="card-body">
                        {{ __('Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

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

                            <div class="form-group row mb-0">
                                <div class="col-md-8 mx-auto">
                                    <button type="submit" class="btn btn-outline-light btn-block rounded-pill mx-auto">
                                        {{ __('Confirm Password') }}
                                    </button>

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
