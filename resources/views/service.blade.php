@extends('layouts.app')

@section('title', $section->label . ' – Barocco Art')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@php
    // first image is the big one, others go to gallery
    $cover  = $section->images->first();
    $gallery = $section->images->skip(1);
@endphp

@section('content')

    <section class="service-intro {{ $cover ? '' : 'service-intro--no-image' }}">
        <div class="service-intro__text">
            <p class="eyebrow">{{ $section->label }}</p>
            <h1>{{ $section->title }}</h1>

            <p>{{ $section->intro }}</p>

            {{-- items are the bold lines --}}
            @foreach ($section->items ?? [] as $item)
                <p><strong>{{ $item['term'] }}</strong> – {{ $item['text'] }}</p>
            @endforeach
        </div>

        {{-- big image only if section has one --}}
        @if ($cover)
            <div class="image-frame service-intro__image">
                <img src="{{ $cover->url() }}" alt="{{ $cover->alt_text ?? $section->title }}">
            </div>
        @endif
    </section>

    @if ($gallery->isNotEmpty())
        <div class="gallery">
            @foreach ($gallery as $image)
                <div class="gallery-item">
                    <img src="{{ $image->url() }}" alt="{{ $image->alt_text ?? $section->title }}" loading="lazy">
                </div>
            @endforeach
        </div>
    @endif

    {{-- buttons at the bottom --}}
    <div class="service-actions">
        <a href="{{ route('services') }}" class="btn">← Atpakaļ uz pakalpojumiem</a>
        <a href="{{ route('contacts') }}" class="btn btn--solid">Sazināties</a>
    </div>

@endsection
