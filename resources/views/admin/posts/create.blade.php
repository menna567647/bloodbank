@extends('admin.layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i> {{ __('messages.ADDPOST') }}
                        </h5>
                    </div>

                    <form enctype="multipart/form-data" method="post" action="{{ route('admin.posts.store') }}">
                        @csrf
                        <div class="card-body">

                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.title') }}</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" placeholder="{{ __('messages.Enter Title') }}"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.content') }}</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                    placeholder="{{ __('messages.Enter Content') }}" rows="4">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.image') }}</label>
                                <span class="text-danger">*</span>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="form-label">{{ __('messages.category') }}</label>
                                <span class="text-danger">*</span>
                                <br>
                                <select name="category_id" id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                    <option></option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-end bg-light">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane me-1"></i> {{ __('messages.ADDPOST') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection
