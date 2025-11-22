<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dados Insuficientes</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container" style="text-align: center;"> 
        <h1>⚠️ Ops! Dados Insuficientes para Votação.</h1>
        <p>A votação "FaceSmash" exige pelo menos duas pessoas na base de dados ('persons').</p>
        <p>Por favor, adicione mais competidores ou execute o Seeder novamente.</p>

        {{-- Usamos a classe 'btn' para estilizar o link como um botão --}}
        <p style="margin-top: 20px;"><a href="{{ route('ranking.index') }}" class="btn">Ver Ranking</a></p>
    </div>
</body>
</html>