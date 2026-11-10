@extends('layouts.app')

@section('title', 'Pakalpojumi – Barocco Art')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')

    <section class="hero">
        <p class="eyebrow">Pilns projektēšanas pakalpojumu serviss</p>
        <h1>Pakalpojumi</h1>
        <p>
            Arhitektūras daļa, ģenplāns, būvkonstrukcijas, inženiertehniskie tīkli
            un autoruzraudzība vienotā komandā.
        </p>
    </section>

    {{-- card for every section --}}
    @foreach ($sections as $section)
        @php
            // first image goes on the card
            $image = $section->images->first();
        @endphp

        <a href="{{ route('service', $section) }}"
           class="card service-card {{ $image ? '' : 'service-card--no-image' }}">

            <div class="service-card__text">
                <p class="eyebrow">{{ $section->label }}</p>
                <h2>{{ $section->title }}</h2>
                <p>{{ $section->intro }}</p>
                <span class="link">Lasīt vairāk</span>
            </div>

            {{-- some sections dont have an image yet --}}
            @if ($image)
                <div class="image-frame">
                    <img src="{{ $image->url() }}" alt="{{ $section->label }}" loading="lazy">
                </div>
            @endif
        </a>
    @endforeach

@endsection
