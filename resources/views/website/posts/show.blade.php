@extends('website.layouts.main', [
    'bodyClass' => 'article-details',
])
@section('content')
    <br>
    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-ltr.html">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a
                                href="#">{{ __('messages.category') }} : {{ $post->category->name }}</a>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">{{ __('messages.articles') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="article-image">
                <img src={{ asset($post->images) }}>
            </div>
            <div class="article-title col-12">
                <div class="h-text col-6">
                    <h4>{{ $post->title }}</h4>
                </div>
                <div class="icon col-6">
                    <form action="{{ route('website.favorites.save.generic', ['id' => $post->id, 'redirectTo' => 'details']) }}"
                        method="post">
                        @csrf
                        <button class="love-btn" type="submit" data-id="{{ $post->id }}">
                            <i class="far fa-heart"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!--text-->
            <div class="text">
                <p>
                    {{ $post->content }} </p>
            </div>

            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>{{ __('messages.relatedarticles') }}</h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @foreach ($relatedPosts as $item)
                                <div class="card">
                                    <div class="photo">
                                        <img src={{ asset($item->images) }} class="card-img-top" alt="...">
                                        <a href="{{ route('website.articles.show', $item->id) }}"
                                            class="click">{{ __('messages.showmore') }}</a>
                                    </div>
                                    <form
                                        action="{{ route('website.favorites.save.generic', ['id' => $item->id, 'redirectTo' => 'details']) }}"
                                        method="post">
                                        @csrf
                                        <button class="love-btn" type="submit" data-id="{{ $item->id }}">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </form>

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text">
                                            {{ Str::limit($item->content, 150) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('website.layouts.partials.favorite-script')
@endsection