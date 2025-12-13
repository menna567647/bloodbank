@extends('website.layouts.main', [
    'bodyClass' => 'article-details',
])@section('content')
<br>
<!--inside-article-->
<div class="inside-article">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="#">{{ __('messages.favorites') }}</a>
                </ol>
            </nav>
        </div>
        @foreach ($favoritePosts as $item)
            <div class="favorite-article mt-3"
                style="border:1px solid #ddd; border-radius:10px; padding:15px; margin-bottom:20px; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
                <div class="article-image"
                    style="width:100%; height:250px; border-radius:8px; overflow:hidden; margin-bottom:15px;">
                    <img src="{{ asset($item->images) }}" alt="{{ $item->title }}"
                        style="width:100%; height:100%; object-fit:contain; display:block;">
                </div>

                <div class="article-title"
                    style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <div class="h-text">
                        <h4 style="margin:0;">{{ $item->title }}</h4>
                    </div>
                    <div class="icon">
                        <form
                            action="{{ route('website.favorites.save.generic', ['id' => $item->id, 'redirectTo' => 'favorites']) }}"
                            method="post">
                            @csrf
                            <button class="love-btn" type="submit" data-id="{{ $item->id }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text" style="font-size:1rem; line-height:1.6;">
                    <p>{{ $item->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <div class="d-flex justify-content-between align-items-center mt-4 p-3 shadow-sm rounded"
            style="background:#fff; border:1px solid #eee; max-width:600px; width:100%;">
            <a href="{{ route('website.articles.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> {{ __('messages.back') }}
            </a>
            <div class="pagination-wrapper mb-0">
                {{ $favoritePosts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@include('website.layouts.partials.favorite-script')
@endsection
