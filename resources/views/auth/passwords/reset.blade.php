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

                                <form method="POST" action="{{ route('password.update') }}" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Reset Password') }}
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
