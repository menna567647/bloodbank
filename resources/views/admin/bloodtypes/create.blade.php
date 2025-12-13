@extends('admin.layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card -->
                <div class="card shadow border-0">
                    <div class="card-header bg-light text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            {{ __('messages.ADDBLOODTYPE') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.bloodtypes.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    {{ __('messages.bloodtype') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('messages.Enter Blood type name') }}" value="{{ old('name') }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-start align-items-center">
                                <button type="submit" class="btn btn-outline-primary btn-sm mr-3">
                                    <i class="fas fa-save me-1"></i> {{ __('messages.ADD') }}
                                </button>
                                <a href="{{ route('admin.bloodtypes.index') }}" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-arrow-right"></i> {{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
