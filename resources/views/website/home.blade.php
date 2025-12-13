@extends('website.layouts.main')
@section('content')
    <!--intro-->
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>{{ __('messages.slider_title') }}</h3>
                            <p>
                                {{ __('messages.slider_text') }}
                            </p>
                            <a href="#">{{ __('messages.more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>{{ __('messages.slider_title') }}</h3>
                            <p>
                                {{ __('messages.slider_text') }} </p>
                            <a href="#">{{ __('messages.more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>{{ __('messages.slider_title') }}</h3>
                            <p>
                                {{ __('messages.slider_text') }} </p>
                            <a href="#">{{ __('messages.more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>{{ __('messages.bloodbank') }}</span> {{ __('messages.about_bloodbank') }}
                </p>
            </div>
        </div>
    </div>
    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>{{ __('messages.articles') }}</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                        @foreach ($posts as $item)
                            <div class="card">
                                <div class="photo">
                                    <img src={{ asset($item->images) }} class="card-img-top rounded-3 mb-3 img-fluid"
                                        alt="Post Image" style="height: 300px; object-fit: contain; width: 100%;">
                                    <a href="{{ route('website.articles.show', $item->id) }}"
                                        class="click">{{ __('messages.showmore') }}</a>
                                </div>
                                <a href="#" class="favourite">
                                    <i class="far fa-heart"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title"> {{ $item->title }} </h5>
                                    <p class="card-text">
                                        {{ Str::limit($item->content, 150) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--requests-->
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>{{ __('messages.DonationRequests') }}</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <form class="row filter">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>{{ __('messages.choosebloodtype') }}</option>
                                    @foreach ($bloodTypes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>{{ __('messages.choosecity') }}</option>
                                    @foreach ($governorates as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 search">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="patients">
                    @foreach ($donations as $item)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{ $item->bloodType->name }}</h2>
                            </div>
                            <ul>
                                <li><span>{{ __('messages.patientname') }}:</span>{{ $item->patient_name }} </li>
                                <li><span>{{ __('messages.hospital') }}:</span> {{ $item->hospital_name }}</li>
                                <li><span>{{ __('messages.city') }}:</span> {{ $item->city->name }}</li>
                            </ul>
                            <a href="{{ route('website.details', $item->id) }}">{{ __('messages.details') }}</a>
                        </div>
                    @endforeach
                </div>
                <div class="more">
                    <a href="donation-requests.html">{{ __('messages.more') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>{{ __('messages.contactus') }}</h3>
                </div>
                <p class="text">{{ __('messages.contact_message') }}</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src={{ asset('dist/img/whats.png') }}>
                        <p dir="ltr">+002 1215454551</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>{{ __('messages.bloodbankapp') }}</h3>
                    <p>
                        {{ __('messages.app_text') }}
                    </p>
                    <div class="download">
                        <h4>{{ __('messages.available') }}</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src={{ asset('dist/img/google.png') }}>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src={{ asset('dist/img/ios.png') }}>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src={{ asset('dist/img/App.png') }}>
                </div>
            </div>
        </div>
    </div>
@endsection
