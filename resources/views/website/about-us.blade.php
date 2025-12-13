@extends('website.layouts.main', [
    'bodyClass' => 'who-are-us',
])
@section('content')
    <br>
    <!--inside-article-->
    <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.whoareus') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="logo">
                    <img src={{ asset('dist/img/logo-ltr.png') }}>
                </div>
                <div class="text">
                    <p>
                        {{__('messages.about_us1')}}
                   </p>
                    <p>
                        {{__('messages.about_us2')}}
                   </p>
                    <p>
                        {{__('messages.about_us3')}}
                   </p>
                </div>
            </div>
        </div>
    </div>
@endsection