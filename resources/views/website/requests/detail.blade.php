@extends('website.layouts.main', [
    'bodyClass' => 'inside-request',
])
@section('content')
    <!--ask-donation-->
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('website.requests') }}">{{ __('messages.DonationRequests') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.DonationRequest') }}:
                            {{ $donation->patient_name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="person">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>{{ __('messages.name') }}</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donation->patient_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>{{ __('messages.bloodtype') }}</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{ $donation->bloodType->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>{{ __('messages.age') }}</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donation->patient_age }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>{{ __('messages.number_of_bags') }}</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donation->number_of_bags }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>{{ __('messages.hospitalname') }}</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donation->hospital_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>{{ __('messages.phone') }}</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donation->patient_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="inside">
                                <div class="info">
                                    <div class="special-dark dark">
                                        <p>{{ __('messages.address') }}</p>
                                    </div>
                                    <div class="special-light light">
                                        <p>{{ $donation->city->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-button">
                        <a href="#">{{ __('messages.notes') }}</a>
                    </div>
                </div>
                <div class="text">
                    <p>
                        {{ $donation->notes }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection