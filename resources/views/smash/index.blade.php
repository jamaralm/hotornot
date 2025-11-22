<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaceSmash - Quem é o Mais Bonito?</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    
    {{-- Exibe a mensagem de sucesso após o voto (usada com o JS) --}}
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    
    @php
        $person1 = $pair[0];
        $person2 = $pair[1];
    @endphp

    <h2 style="text-align: center;">Quem você acha que é o mais bonito(a)?</h2>
    
    <div class="smash-grid"> 
        
        <form method="POST" action="{{ route('smash.vote') }}">
            @csrf
            <input type="hidden" name="winner_id" value="{{ $person1->id }}">
            <input type="hidden" name="loser_id" value="{{ $person2->id }}">

            <div class="person-card" onclick="this.closest('form').submit()">
                <img src="{{ asset($person1->image_path) }}" alt="{{ $person1->name }}">
                <h3>{{ $person1->name }}</h3>
                <button type="submit">VOTAR NESTE</button>
            </div>
        </form>


        <form method="POST" action="{{ route('smash.vote') }}">
            @csrf
            <input type="hidden" name="winner_id" value="{{ $person2->id }}">
            <input type="hidden" name="loser_id" value="{{ $person1->id }}">

            <div class="person-card" onclick="this.closest('form').submit()">
                <img src="{{ asset($person2->image_path) }}" alt="{{ $person2->name }}">
                <h3>{{ $person2->name }}</h3>
                <button type="submit">VOTAR NESTE</button>
            </div>
        </form>
        
    </div>

    {{-- Link para o Ranking --}}
    <p style="text-align: center; margin-top: 30px;"><a href="{{ route('ranking.index') }}">Ver o Ranking Completo</a></p>

</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>