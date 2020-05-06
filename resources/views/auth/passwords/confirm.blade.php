@extends('layouts.form')

@section('content')
<div class="card col-md-6 bg-white" style="width: 18rem;">
    <div class="card-header bg-white text-center">
        <h3>{{ __('Confirm Password') }}</h3>
    </div>

    <div class="card-body">
        {{ __('Please confirm your password before continuing.') }}

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-8 mx-auto">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block mx-auto">
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


@endsection
