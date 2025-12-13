@extends('website.layouts.main')
@section('content')
<br>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-dark border-bottom">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-shield-alt text-primary me-2"></i> {{ __('messages.changepassword') }}
                        </h5>
                    </div>
                    <form method="post" action="{{ route('website.change.password')}}">
                        @csrf
                        <div class="card-body">
                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.password') }}</label>
                                <span class="text-danger">*</span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="{{ __('messages.Enter new password') }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.passwordconfirmation') }}</label>
                                <span class="text-danger">*</span>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="{{ __('messages.passwordconfirmation') }}">
                            </div>
                        </div>

                        <div class="card-footer text-end bg-light">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key me-1"></i> {{ __('messages.changepassword') }}
                            </button>

                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection