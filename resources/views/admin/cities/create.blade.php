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
                            {{ __('messages.addcity') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.cities.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    {{ __('messages.city') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('messages.Enter City name') }}"
                                    value="{{ old('name') }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.Governoratename') }}</label>
                                <span class="text-danger">*</span>
                                <br>
                                <select name="governrate_id" id="governrate_id"
                                    class="form-control @error('governrate_id') is-invalid @enderror">
                                    <option></option>
                                    @foreach ($governrats as $item)
                                        <option value="{{ $item->id }}" {{ old('governrate_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('governrate_id')
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
                                <a href="{{ route('admin.cities.index') }}" class="btn btn-outline-success btn-sm"><i
                                        class="fa-solid fa-arrow-right"></i> {{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection