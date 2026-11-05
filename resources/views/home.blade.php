@extends('layouts.app')

@section('title', 'Barocco Art')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    {{-- Intro --}}
    <section class="hero">
        <h1>{{ $home->hero_title }}</h1>
        <p>{{ $home->hero_text }}</p>
    </section>

    {{-- Gallery: images ticked "Rādīt sākumlapas galerijā" in the admin --}}
    @if ($images->isNotEmpty())
        <div class="gallery">
            @foreach ($images as $image)
                <div class="gallery-item">
                    <img src="{{ $image->url() }}" alt="{{ $image->alt_text }}" loading="lazy">
                </div>
            @endforeach
        </div>
    @endif

    {{-- Services --}}
    <section class="card services-block">
        <div class="services-intro">
            <p class="eyebrow">{{ $home->services_eyebrow }}</p>
            <h2>{{ $home->services_title }}</h2>
            <p>{{ $home->services_text }}</p>
            <a href="{{ route('services') }}" class="link">Visi pakalpojumi</a>
        </div>

        @if (! empty($home->services_items))
            <div class="services-grid">
                @foreach ($home->services_items as $item)
                    <div class="service-item">
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Contact --}}
    <section class="card contact-block">
        <div>
            <p class="eyebrow">{{ $home->contact_eyebrow }}</p>
            <h2>{{ $home->contact_title }}</h2>
            <p>{{ $home->contact_text }}</p>
        </div>
        <div class="contact-buttons">
            @if ($home->contact_email)
                <a href="mailto:{{ $home->contact_email }}" class="btn">E-pasts</a>
            @endif
            @if ($home->contact_phone)
                <a href="{{ $home->phoneLink() }}" class="btn">Zvanīt</a>
            @endif
        </div>
    </section>

@endsection
