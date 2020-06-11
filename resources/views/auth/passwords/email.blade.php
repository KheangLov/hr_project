@extends('layouts.auth')

@section('content')
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-8">
            <div class="card card-auth">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <div class="bg-light h-100" style="background-image: url({{ asset('images/forgot-password.png') }}); background-repeat: no-repeat; background-position: center center; background-size: contain;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-auth">
                                <h2 class="auth-header">{{ __('Reset Password') }}</h2>
                                <span class="text-white-50">Please enter your email address and we'll send you instructions on how to reset your password.</span>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}" class="mt-3">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
