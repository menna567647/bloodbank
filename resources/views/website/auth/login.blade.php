@extends('website.layouts.main', [
    'bodyClass' => 'signin-account',
])
@section('content')
    <!--form-->
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.signin') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                <form method="post" action="{{ route('website.login.submit') }}">
                    @csrf
                    <div class="logo">
                        <img src={{ asset('dist/img/logo.png') }}>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="Email" aria-describedby="emailHelp" placeholder="{{ __('messages.email') }}"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="Password" placeholder="{{ __('messages.password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="row options">
                        <div class="col-md-6 remember">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">{{ __('messages.remember') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6 forgot">
                            <img src={{ asset('dist/img/complain.png') }}>
                            <a href="#">{{ __('messages.forgetpassword') }}</a>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-md-6 right">
                            <button type="submit">{{ __('messages.signin') }}</button>
                        </div>
                        <div class="col-md-6 left">
                            <a href="{{ route('website.register.view') }}">{{ __('messages.register') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection