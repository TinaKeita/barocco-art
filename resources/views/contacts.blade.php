@extends('layouts.app')

@section('title', 'Kontakti – Barocco Art')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
@endpush

@section('content')

    {{-- page intro --}}
    <section class="hero">
        <p class="eyebrow">Projektēšanas birojs Barocco Art</p>
        <h1>Arhitektūra · Interjers · Projektēšana · Būvniecība</h1>
        <p>
            Sazinieties ar mums par interjera dizainu, arhitektūru vai būvniecības risinājumiem.
            Zemāk atradīsiet tiešos kontaktus atbildīgajiem cilvēkiem.
        </p>
    </section>

    <div class="contacts-grid">
        {{-- one card for each contact from database --}}
        @foreach ($contacts as $contact)
            <section class="card contact-card">
                {{-- every second avatar has other color --}}
                <div class="avatar {{ $loop->even ? 'avatar--alt' : '' }}">
                    {{ $contact->initials }}
                </div>

                <p class="eyebrow">{{ $contact->role }}</p>
                <h2>{{ $contact->name }}</h2>

                <dl>
                    {{-- email and phone only show if they are filled --}}
                    @if ($contact->email)
                        <dt>E-pasts</dt>
                        <dd>
                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                        </dd>
                    @endif

                    @if ($contact->phone)
                        <dt>Telefons</dt>
                        <dd>
                            <a href="{{ $contact->phoneLink() }}">{{ $contact->phone }}</a>
                            <span class="muted">{{ $contact->phone_note }}</span>
                        </dd>
                    @endif
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
