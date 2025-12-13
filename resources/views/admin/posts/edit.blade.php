@extends('admin.layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i> {{ __('messages.UPDATEPOST') }}
                        </h5>
                    </div>

                    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.title') }} <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="{{ __('messages.Enter Title') }}"
                                       value="{{ old('title', $post->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.content') }} <span class="text-danger">*</span></label>
                                <textarea name="content"
                                          class="form-control @error('content') is-invalid @enderror"
                                          placeholder="{{ __('messages.Enter Content') }}"
                                          rows="5">{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.image') }}</label>
                                <input type="file"
                                       name="image"
                                       class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                @if ($post->image)
                                    <div class="mt-2">
                                        <small class="text-muted">{{ __('messages.current_image') }}:</small><br>
                                        <img src="{{ asset('uploads/' . $post->image) }}" alt="Post Image" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                            </div>

                            <!-- Hidden Category -->
                            <input type="hidden" name="category_id" value="{{ $post->category_id }}">

                        </div>

                        <div class="card-footer bg-light text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> {{ __('messages.edit') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection