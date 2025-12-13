@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('messages.posts') }}</li>
                    <ul class="nav nav-treeview">
                        <a href="{{ route('admin.posts.index') }}"
                            class="nav-link {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}">
                            <i
                                class="{{ request()->routeIs('admin.posts.index') ? 'fas fa-dot-circle' : 'far fa-circle' }} nav-icon"></i>
                            <p>{{ __('messages.All Posts') }}</p>
                        </a>

                        @foreach ($categories as $item)
                            <li class="nav-item">
                                <a href="{{ route('admin.byCategory', $item->id) }}" class="nav-link {{ request()->routeIs('admin.byCategory', $item->id) ? 'active' : '' }}">
                                    <i
                                class="{{ request()->routeIs('admin.byCategory', $item->id) ? 'fas fa-dot-circle' : 'far fa-circle' }} nav-icon"></i>
                            
                                {{-- <i class="far fa-circle nav-icon"></i> --}}

                                    <p>{{ $item->name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a class="btn btn-outline-primary btn-sm mt-2" href="{{ route('admin.posts.create') }}">
                                {{ __('messages.createpost') }}
                            </a>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                                   @include('admin.layouts.partials.session')

                        <div class="row justify-content-center">
                            @forelse ($posts as $item)
                                <div class="col-12 mb-4">
                                    <div class="card shadow rounded-4 border-0 bg-light p-3">

                                        @if ($item->images)
                                            <img src="{{ asset($item->images) }}"
                                                class="card-img-top rounded-3 mb-3 img-fluid" alt="Post Image"
                                                style="height: 300px; object-fit: contain; width: 100%;">
                                        @else
                                            <p>No Image.</p>
                                        @endif

                                        <div class="card-body p-0">
                                            <h4 class="fw-bold text-center" style="text-align: center !important;">
                                                {{ $item->title }}
                                            </h4>
                                            @php
                                                $isLong = strlen($item->content) > 150;
                                            @endphp
                                            <p class="card-text text-muted mt-2 mb-4">
                                                <span id="content-short-{{ $item->id }}">
                                                    {{ $isLong ? \Illuminate\Support\Str::limit($item->content, 150) : $item->content }}
                                                </span>
                                                @if ($isLong)
                                                    <span id="content-full-{{ $item->id }}" class="d-none">
                                                        {{ $item->content }}
                                                    </span>
                                                    <a href="javascript:void(0);"
                                                        onclick="toggleContent({{ $item->id }})"
                                                        id="content-btn-{{ $item->id }}" class="text-primary ms-1"
                                                        style="text-decoration: underline; font-size: 0.9em;">
                                                        {{ __('messages.showmore') }}
                                                    </a>
                                                @endif
                                            </p>
                                            <h4 class="text-muted small">Category : {{ $item->category->name }}</h4>

                                            <div class="d-flex justify-content-start mt-3">
                                                <a href="{{ route('admin.posts.edit', $item->id) }}"
                                                    class="btn btn-outline-primary btn-sm mr-2">
                                                    {{ __('messages.edit') }}
                                                </a>
                                                <button type="button"
                                                    data-url="{{ route('admin.posts.destroy', $item->id) }}"
                                                    class="btn btn-outline-danger btn-sm delete-btn">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle"></i> {{ __('messages.No posts found') }}
                                </div>
                            @endforelse
                        </div>
                        <div class="card-footer clearfix">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleContent(id) {
            const shortText = document.getElementById(`content-short-${id}`);
            const fullText = document.getElementById(`content-full-${id}`);
            const btn = document.getElementById(`content-btn-${id}`);

            if (shortText.classList.contains('d-none')) {
                shortText.classList.remove('d-none');
                fullText.classList.add('d-none');
                btn.textContent = '{{ __('messages.showmore') }}';
            } else {
                shortText.classList.add('d-none');
                fullText.classList.remove('d-none');
                btn.textContent = '{{ __('messages.showless') }}';
            }
        }
    </script>

@endpush
              @include('admin.layouts.partials.scripts')
