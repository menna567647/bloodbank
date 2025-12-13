@extends('website.layouts.main', [
    'bodyClass' => 'donation-requests',
])
@section('content')
    <br>
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.DonationRequests') }}</li>
                    </ol>
                </nav>
            </div>
            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>{{ __('messages.DonationRequests') }}</h2>
                </div>
                <div class="content">
                    <form method="get" action="{{ route('website.requests') }}" class="row filter">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="blood_type_id">
                                        <option selected disabled>{{ __('messages.choosebloodtype') }}</option>
                                        @foreach ($bloodTypes as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('blood_type_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="governrate_id">
                                        <option selected disabled>{{ __('messages.choosegovernorate') }}</option>
                                        @foreach ($governrates as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('governrate_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
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
                                    <h2>{{ $item->bloodType->name }}</h2>
                                </div>
                                <ul>
                                    <li><span>{{ __('messages.patientname') }} :</span>{{ $item->patient_name }} </li>
                                    <li><span>{{ __('messages.hospital') }}:</span> {{ $item->hospital_name }}</li>
                                    <li><span>{{ __('messages.city') }}:</span> {{ $item->city->name }}</li>
                                </ul>
                                
                                <a href="{{ route('website.details', $item->id) }}">{{ __('messages.details') }}</a>
                                <br>
                                @auth('client')
                                <a href="{{ route('website.report.create', $item->id) }}">Report
                                </a>
                                @endauth()
                            </div>
                        @endforeach
                    </div>
                    <div class="donation d-flex align-items-center justify-content-center">
                        {{ $donations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
