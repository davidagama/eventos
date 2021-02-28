@extends('layouts.main')

@section('title', 'HDC Events')

@section('content') {{-- Palavras com @ antes são "diretivas do Blade" --}}

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    <h2>Próximos Eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    <div id="cards-container" class="row">
        @foreach($events as $event) {{-- Quando uma variável precisa ser usada na diretiva do Blade, NÃO é necessário as duas chaves {{}} --}}
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
            <div class="card-body">
                <p class="card-date">10/09/2020</p>
                <h5 class="card-title">{{ $event->title }}</h5> {{-- Quando uma variável precisa ser usada no meio do HTML, é necessário as duas chaves {{}} --}}
                <p class="card-participantes">X Participantes</p>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Este comentário aparece na inspeção de elemento no navegador do usuário (comentário do HTML) -->
{{-- Este comentário NÃO aparece na inspeção de elemento no navegador do usuário (comentário do Blade) --}}

@endsection