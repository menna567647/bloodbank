@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="fw-bold">{{ __('messages.dashboard') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-light px-3 py-2 rounded">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('messages.userprofile') }}</li>
                </ol>
            </div>
        </div>
        @include('admin.layouts.partials.session')
    </div>
@endsection

@section('content')
    <div class="row mt-4">
        <!-- Clients -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-start border-4 border-info">
                <span class="info-box-icon bg-info text-white">
                    <i class="fa-solid fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('messages.clients') }}</span>
                    <span class="info-box-number">{{ $totalClients }}</span>
                </div>
            </div>
        </div>

        <!-- Blood Types -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-start border-4 border-success">
                <span class="info-box-icon bg-danger text-white">
                    <i class="fas fa-flag"></i> </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('messages.reports') }}</span>
                    <span class="info-box-number">{{ $totalReports }}</span>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-start border-4 border-warning">
                <span class="info-box-icon bg-warning text-white">
                    <i class="fa-solid fa-list"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('messages.categories') }}</span>
                    <span class="info-box-number">{{ $totalCategories }}</span>
                </div>
            </div>
        </div>

        <!-- Posts -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-start border-4 border-primary">
                <span class="info-box-icon bg-primary text-white">
                    <i class="fa-solid fa-pen-nib"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('messages.posts') }}</span>
                    <span class="info-box-number">{{ $totalPosts }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
