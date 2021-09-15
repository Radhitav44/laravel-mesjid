@extends('layouts.app')
@section('style')
<link href="{{ asset('assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="statbox widget box box-shadow">
    <div class="widget-content widget-content-area">
        <div class="row">
            @forelse ($posts as $post)
            <div class="col-4">
                <div class="card component-card_9">
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img src="{{ asset('assets/posts/' . $post->image) }}" class="card-img-top" alt="widget-card-2">
                    </a>
                    <div class="card-body">
                        <p class="meta-date">{{ $post->created_at }}</p>

                        <a href="{{ route('posts.show', $post->id) }}">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </a>
                        <p class="card-text">{!! Str::limit($post->body, 30) !!}
                        </p>

                        <div class="meta-info">
                            <div class="meta-user">
                                <div class="avatar avatar-sm">

                                    <span
                                        class="avatar-title rounded-circle">{{ Str::limit($post->user->name, 2, '') }}</span>
                                </div>
                                <div class="user-name">{{ auth()->user()->name }}</div>
                            </div>

                            <div class="meta-action">
                                <div class="meta-view">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg> {{ count($post->views) }}
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="card w-100 m-2">
                <div class="card-body">
                    Belum ada postingan!
                </div>
            </div>
            @endforelse
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
