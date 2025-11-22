<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FaceSmash - Ranking</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h1>🏆 Ranking Global FaceSmash</h1>
    <p><a href="{{ route('smash.index') }}">← Voltar para a Votação</a></p>

    {{-- Aplicamos a classe de estilo da tabela --}}
    <table class="ranking-table">
        <thead>
            <tr>
                <th class="rank-number">#</th>
                <th>Foto</th>
                <th>Nome</th>
                <th>Pontuação (Score)</th>
                <th>Votos Recebidos</th>
                </tr>
        </thead>
        <tbody>
            @php $rank = $ranking->firstItem() @endphp 

            @foreach ($ranking as $person)
            <tr>
                <td class="rank-number">{{ $rank++ }}</td>
                <td>
                    {{-- Usa a classe 'person-image' para foto circular --}}
                    <img src="{{ asset($person->image_path) }}" alt="{{ $person->name }}" class="person-image">
                </td>
                <td>{{ $person->name }}</td>
                <td>{{ round($person->score) }}</td>
                <td>{{ $person->votes_received }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Renderiza os links de paginação do Eloquent --}}
    <div style="margin-top: 20px; text-align: center;">
        {{ $ranking->links() }}
    </div>

</div>

</body>
</html>