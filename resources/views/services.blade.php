@extends('layouts.app')

@section('title', 'Pakalpojumi – Barocco Art')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@php
    // Temporary data. In Step 3 this comes from the `sections` table
    // and is passed in from the route instead.
    // 'image' stays null until images are added through the admin.
    $sections = [
        [
            'slug'  => 'celtnieciba',
            'label' => 'Celtniecība',
            'title' => 'Arhitektūra, projektēšana',
            'text'  => 'Pilns projektēšanas pakalpojumu serviss. Arhitektūras daļa, ģenplāna daļa, būvkonstrukcijas, inženiertehniskie tīkli. Autoruzraudzība.',
            'image' => null,
        ],
        [
            'slug'  => 'projektesana',
            'label' => 'Projektēšana',
            'title' => 'Arhitektūra, projektēšana',
            'text'  => 'Pilns projektēšanas pakalpojumu serviss. Arhitektūras daļa, ģenplāna daļa, būvkonstrukcijas, inženiertehniskie tīkli. Autoruzraudzība.',
            'image' => null,
        ],
        [
            'slug'  => 'interjera-dizains',
            'label' => 'Interjera dizains',
            'title' => 'Interjera projekti',
            'text'  => 'Izstrādājam pilnu interjera projektu saskaņā ar klienta vēlmēm. Projektiem nodrošinām autoruzraudzību.',
            'image' => null,
        ],
        [
            'slug'  => 'mebeles',
            'label' => 'Mēbeles',
            'title' => 'Mēbeles',
            'text'  => 'Pielāgoti mēbeļu risinājumi, kas iederas telpas arhitektūrā un akcentē materiālu kvalitāti.',
            'image' => null,
        ],
    ];
@endphp

@section('content')

    <section class="hero">
        <p class="eyebrow">Pilns projektēšanas pakalpojumu serviss</p>
        <h1>Pakalpojumi</h1>
        <p>
            Arhitektūras daļa, ģenplāns, būvkonstrukcijas, inženiertehniskie tīkli
            un autoruzraudzība vienotā komandā.
        </p>
    </section>

    @foreach ($sections as $section)
        <a href="{{ route('service', $section['slug']) }}"
           class="card service-card {{ $section['image'] ? '' : 'service-card--no-image' }}">

            <div class="service-card__text">
                <p class="eyebrow">{{ $section['label'] }}</p>
                <h2>{{ $section['title'] }}</h2>
                <p>{{ $section['text'] }}</p>
                <span class="link">Lasīt vairāk</span>
            </div>

            @if ($section['image'])
                <div class="image-frame">
                    <img src="{{ $section['image'] }}" alt="{{ $section['title'] }}" loading="lazy">
                </div>
            @endif
        </a>
    @endforeach

@endsection