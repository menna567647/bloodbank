@extends('website.layouts.main', [
    'bodyClass' => 'contact-us',
])
@section('content')
    <br>
    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.contactus') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>{{ __('messages.contactus') }}</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src={{ asset('dist/img/logo-ltr.png') }}>
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>{{ __('messages.phone') }}:</span> 124123412312</li>
                                    <li><span>{{ __('messages.fax') }}:</span> 234234234</li>
                                    <li><span>{{ __('messages.email') }}:</span> name@name.com</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>{{ __('messages.contactus') }}</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="#"><img src={{ asset('dist/img/001-facebook.svg') }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src={{ asset('dist/img/002-twitter.svg') }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src={{ asset('dist/img/003-youtube.svg') }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src={{ asset('dist/img/004-instagram.svg') }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src={{ asset('dist/img/005-whatsapp.svg') }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src={{ asset('dist/img/006-google-plus.svg') }}></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>{{ __('messages.connect') }}</h4>
                        </div>
                        <div class="fields">
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="post" action="{{ route('website.contact.store') }}">
                                @csrf
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="{{ __('messages.name') }}" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger d-block" style="margin-top: 4px;">{{ $message }}</span>
                                @enderror


                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="{{ __('messages.email') }}" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger d-block" style="margin-top: 4px;">{{ $message }}</span>
                                @enderror

                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="{{ __('messages.phone') }}" name="phone"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger d-block" style="margin-top: 4px;">{{ $message }}</span>
                                @enderror

                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="{{ __('messages.messagetitle') }}"
                                    name="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger d-block" style="margin-top: 4px;">{{ $message }}</span>
                                @enderror

                                <textarea placeholder="{{ __('messages.text') }}" class="form-control @error('text') is-invalid @enderror"
                                    id="exampleFormControlTextarea1" rows="3" name="text">{{ old('text') }}</textarea>
                                @error('text')
                                    <span class="text-danger d-block" style="margin-top: 4px;">{{ $message }}</span>
                                @enderror

                                <button type="submit">{{ __('messages.send') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
