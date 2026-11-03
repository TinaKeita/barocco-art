@extends('layouts.app')

@section('title', 'Kontakti – Barocco Art')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
@endpush

@php
    // Temporary data. In Step 3 this comes from the `contacts` table
    // and is passed in from the route instead.
    $contacts = [
        [
            'initials' => 'AL',
            'role'     => 'Arhitektūra, projektēšana',
            'name'     => 'Armands Lūsis',
            'email'    => 'armands@baroccoart.lv',
            'phone'    => '+371 2 949 4338',
            'note'     => 'gsm',
        ],
        [
            'initials' => 'BI',
            'role'     => 'Birojs',
            'name'     => 'Brīvības iela 137 Rīga, Latvija',
            'email'    => 'barocco@baroccoart.lv',
            'phone'    => '+371 26262626',
            'note'     => 'WhatsApp',
        ],
    ];
@endphp

@section('content')

    <section class="hero">
        <p class="eyebrow">Projektēšanas birojs Barocco Art</p>
        <h1>Arhitektūra · Interjers · Projektēšana · Būvniecība</h1>
        <p>
            Sazinieties ar mums par interjera dizainu, arhitektūru vai būvniecības risinājumiem.
            Zemāk atradīsiet tiešos kontaktus atbildīgajiem cilvēkiem.
        </p>
    </section>

    <div class="contacts-grid">
        @foreach ($contacts as $contact)
            <section class="card contact-card">
                <div class="avatar {{ $loop->even ? 'avatar--alt' : '' }}">
                    {{ $contact['initials'] }}
                </div>

                <p class="eyebrow">{{ $contact['role'] }}</p>
                <h2>{{ $contact['name'] }}</h2>

                <dl>
                    <dt>E-pasts</dt>
                    <dd>
                        <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                    </dd>

                    <dt>Telefons</dt>
                    <dd>
                        <a href="tel:{{ str_replace(' ', '', $contact['phone']) }}">{{ $contact['phone'] }}</a>
                        <span class="muted">{{ $contact['note'] }}</span>
                    </dd>
                </dl>
            </section>
        @endforeach
    </div>

    <section class="card contact-block">
        <div>
            <p class="eyebrow">Sazināties</p>
            <h2>Pastāsti par savu projektu</h2>
            <p>
                Raksti mums jebkurā laikā. Atbildēsim, lai vienotos par nākamajiem
                soļiem un tikšanās laiku.
            </p>
        </div>
        <div class="contact-buttons">
            <a href="mailto:barocco@baroccoart.lv" class="btn">barocco@baroccoart.lv</a>
            <a href="tel:+37126262626" class="btn">+371 26262626</a>
            <a href="https://wa.me/37126262626" class="btn btn--solid" target="_blank" rel="noopener">WhatsApp</a>
        </div>
    </section>

@endsection