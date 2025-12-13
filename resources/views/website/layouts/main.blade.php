<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="icon" href={{ asset('dist/img/Icon.png') }}>

    <!--owl-carousel css-->
    <link rel="stylesheet" href={{ asset('dist/css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('dist/css/owl.theme.default.min.css') }}>

    <!--style css-->
    <link rel="stylesheet" href={{ asset('dist/css/style.css') }}>

    <title>Blood Bank</title>
</head>

<body class="{{ $bodyClass ?? '' }}">
    <!--upper-bar-->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="language">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="text-white" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social">
                        <div class="icons">

                            <a href="{{ $settings->fb_url }}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $settings->app_store__url }}" class="instagram"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="{{ $settings->x_url }}" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $settings->phone }}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            @auth('client')
                                <a href="{{ route('website.client.notifications') }}">{{ $notifications_count }} <i
                                        class="far fa-bell"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- not a member-->
                    <div class="col-lg-4">
                        <div class="info" dir="ltr">
                            <div class="phone">
                                <i class="fas fa-phone-alt"></i>
                                <p>+966506954964</p>
                            </div>
                            <div class="e-mail">
                                <i class="far fa-envelope"></i>
                                <p>name@name.com</p>
                            </div>
                        </div>
                        <I'm a member <div class="member">
                            <p class="welcome">{{ __('messages.welcome') }}</p>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ auth('client')->user()->name }}
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('website.page') }}">
                                        <i class="fas fa-home"></i>
                                        {{ __('messages.home') }}
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('website.profile.edit')}}">
                                        <i class="far fa-user"></i>
                                        {{ __('messages.my_information') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('website.reports.index')}}">
                                        <i class="far fa-comments"></i>
                                        {{ __('messages.report') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('website.posts.favorites') }}">
                                        <i class="far fa-heart"></i>
                                        {{ __('messages.favorites') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('website.client.password') }}">
                                        <i class="fas fa-lock"></i>
                                        {{ __('messages.changepassword') }}
                                    </a>
                                    <form action="{{ route('website.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-sign-out-alt"></i>
                                            {{ __('messages.Logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    </div>
    </div>

    <!--nav-->
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src={{ asset('dist/img/logo.png') }} class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->routeIs('website.page') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('website.page') }}">
                                {{ __('messages.home') }}
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                {{ __('messages.aboutus') }}
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('website.articles.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('website.articles.index') }}">
                                {{ __('messages.articles') }}
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('website.requests') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('website.requests') }}">
                                {{ __('messages.DonationRequests') }}
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('website.about.us') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('website.about.us') }}">
                                {{ __('messages.whoareus') }}
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('website.contact') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('website.contact') }}">
                                {{ __('messages.contactus') }}
                            </a>
                        </li>
                    </ul>
                    @guest('client')
                        <div class="accounts">
                            <a href="{{ route('website.register.view') }}"
                                class="create">{{ __('messages.register') }}</a>
                            <a href="{{ route('website.login.view') }}" class="signin">{{ __('messages.signin') }}</a>
                        </div>
                    @endguest
                    <!--not a member-->
                    @auth('client')
                        <a href="{{ route('website.donations.index') }}" class="donate">
                            <img src={{ asset('dist/img/transfusion.svg') }}>
                            <p>{{ __('messages.MyDonationRequests') }}</p>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
    @include('website.layouts.partials.session')

    @yield('content')

    <!--footer-->
    <div class="footer">
        <div class="inside-footer">
            <div class="container">
                <div class="row">
                    <div class="details col-md-4">
                        <img src={{ asset('dist/img/logo-ltr.png') }}>
                        <h4>{{ __('messages.bloodbank') }}</h4>
                        <p>
                            {{ __('messages.footer_text') }}
                        </p>
                    </div>
                    <div class="pages col-md-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                href="{{ route('website.page') }}" role="tab"
                                aria-controls="home">{{ __('messages.home') }}</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" href="#"
                                role="tab" aria-controls="profile">{{ __('messages.about_blood_bank') }}</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                href="{{ route('website.articles.index') }}" role="tab"
                                aria-controls="messages">{{ __('messages.articles') }}</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{ route('website.requests') }}" role="tab" aria-controls="settings">
                                {{ __('messages.DonationRequests') }}</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{ route('website.about.us') }}" role="tab"
                                aria-controls="settings">{{ __('messages.whoareus') }}</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{ route('website.contact') }}" role="tab"
                                aria-controls="settings">{{ __('messages.contactus') }}</a>
                        </div>
                    </div>
                    <div class="stores col-md-4">
                        <div class="availabe">
                            <p>{{ __('messages.available') }}</p>
                            <a href="#">
                                <img src={{ asset('dist/img/google1.png') }}>
                            </a>
                            <a href="#">
                                <img src={{ asset('dist/img/ios1.png') }}>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="other">
            <div class="container">
                <div class="row">
                    <div class="social col-md-4">

                        <div class="icons">
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="rights col-md-8">
                        <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src={{ asset('dist/js/bootstrap.bundle.js') }}></script>
    <script src={{ asset('dist/js/bootstrap.bundle.min.js') }}></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous">
    </script>

    <script src={{ asset('dist/js/owl.carousel.min.js') }}></script>

    <script src={{ asset('dist/js/main.js') }}></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
    @stack('scripts')
</body>

</html>
