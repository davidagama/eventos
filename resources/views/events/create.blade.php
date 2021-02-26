@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf {{-- Proteção do Laravel contra ataques a formulários --}}
        <div class="form-group">
            <p><label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="form-control-file"></p>
        </div>
        <div class="form-group">
            <p><label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento"></p>
        </div>
        <div class="form-group">
            <p><label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento"></p>
        </div>
        <div class="form-group">
            <p><label for="title">O evento é privado?</label>
            <select name="private" id="private" class="form-control"></p>
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <p><label for="title">Descrição</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea></p>
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@endsection