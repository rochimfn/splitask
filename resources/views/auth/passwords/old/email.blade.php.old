@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow img-fluid">
                <img class="card-img-top rounded" src="https://images.unsplash.com/photo-1557683325-3ba8f0df79de?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80" alt="Login" style="height:250px">
                <div class="card-img-overlay">
                    <div class="card-header border-bottom text-light bg-transparent">
                        <h3>{{ __('Reset Password') }}</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                                <div class="col-md-8 mx-auto">
                                    <input id="email" type="email" placeholder="E-mail Address" class="form-control @error('email') is-invalid @enderror rounded-pill" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 mx-auto">
                                    <button type="submit" class="btn btn-outline-light btn-block rounded-pill mx-auto">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
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
