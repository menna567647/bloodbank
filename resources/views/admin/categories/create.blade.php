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
                            {{ __('messages.addcategory') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">
                                    {{ __('messages.category_en') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name_en" id="name_en"
                                    class="form-control @error('name_en') is-invalid @enderror"
                                    placeholder="{{ __('messages.Enter Name') }}" value="{{ old('name_en') }}">

                                @error('name_en')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name_ar" class="form-label">
                                    {{ __('messages.category_ar') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name_ar" id="name_ar"
                                    class="form-control @error('name_ar') is-invalid @enderror"
                                    placeholder="{{ __('messages.Enter Name') }}" value="{{ old('name_ar') }}">

                                @error('name_ar')
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
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fa-solid fa-arrow-right"></i> {{ __('messages.back') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
