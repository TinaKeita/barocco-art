@extends('layouts.app')

@section('title', 'Barocco Art')

@push('styles')
   <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    {{-- intro text --}}
    <section class="hero">
        <h1>Barocco Art</h1>
        <p>
            Mūsdienīga arhitektūra, tīras līnijas un telpas, kas atdzīvojas gaismā.
            Barocco Art kolekcijā apvienojam privātmājas, industriālos risinājumus
            un radošus interjerus, lai radītu vietas, kas iedvesmo ikvienu apmeklētāju.
        </p>
    </section>

    {{-- gallery only shows if there are images --}}
    @if ($images->isNotEmpty())
        <div class="gallery">
            @foreach ($images as $image)
                <div class="gallery-item">
                    <img src="{{ $image->url() }}" alt="{{ $image->alt_text }}" loading="lazy">
                </div>
            @endforeach
        </div>
    @endif

    {{-- services, this text is written here not from database --}}
    <section class="card services-block">
        <div class="services-intro">
            <p class="eyebrow">Pakalpojumi</p>
            <h2>Telpas, kas strādā jūsu idejai</h2>
            <p>
                No koncepta skicēm līdz realizētām fasādēm un interjeriem.
                Izceļam dabisko gaismu, ilgtspējīgus materiālus un precīzas detaļas,
                lai katrs projekts būtu funkcionāls un vizuāli pārliecinošs.
            </p>
            <a href="{{ route('services') }}" class="link">Visi pakalpojumi</a>
        </div>

        <div class="services-grid">
            <div class="service-item">
                <h3>Dzīvojamās mājas</h3>
                <p>Individuāli risinājumi ar ērtām plānojuma līnijām un plašu stiklojumu.</p>
            </div>
            <div class="service-item">
                <h3>Industriālie objekti</h3>
                <p>Noliktavas, ražotnes un angāri ar optimizētu dienasgaismu un loģistiku.</p>
            </div>
            <div class="service-item">
                <h3>Interjera dizains</h3>
                <p>Minimālisma valoda, kas izceļ materiālu faktūru un gaismu.</p>
            </div>
            <div class="service-item">
                <h3>Konsultācijas</h3>
                <p>Projekta stratēģija, budžeta un materiālu izvēles sesijas.</p>
            </div>
        </div>
    </section>

    {{-- contact buttons --}}
    <section class="card contact-block">
        <div>
            <p class="eyebrow">Kontakti</p>
            <h2>Sazinies ar mums</h2>
            <p>Pastāsti par savu projektu vai ieplāno klātienes tikšanos Barocco Art studijā.</p>
        </div>
        <div class="contact-buttons">
            <a href="mailto:barocco@baroccoart.lv" class="btn">E-pasts</a>
            <a href="tel:+37126262626" class="btn">Zvanīt</a>
        </div>
    </section>

@endsection