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
            <figure class="service-intro__image">
                <div class="image-frame">
                    <img src="{{ $cover->url() }}" alt="{{ $section->label }}">
                </div>

                @if ($cover->caption)
                    <figcaption class="image-caption">{{ $cover->caption }}</figcaption>
                @endif
            </figure>
        @endif
    </section>

    {{-- caption goes under each image if the admin wrote one --}}
    @if ($gallery->isNotEmpty())
        <div class="gallery">
            @foreach ($gallery as $image)
                <figure class="gallery-figure">
                    <div class="image-frame">
                        <img src="{{ $image->url() }}" alt="{{ $section->label }}" loading="lazy">
                    </div>

                    @if ($image->caption)
                        <figcaption class="image-caption">{{ $image->caption }}</figcaption>
                    @endif
                </figure>
            @endforeach
        </div>
    @endif

    {{-- buttons at the bottom --}}
    <div class="service-actions">
        <a href="{{ route('services') }}" class="btn">← Atpakaļ uz pakalpojumiem</a>
        <a href="{{ route('contacts') }}" class="btn btn--solid">Sazināties</a>
    </div>

@endsection
