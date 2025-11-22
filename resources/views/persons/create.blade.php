<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Pessoa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

{{-- Usamos o container, e o CSS definirá a largura máxima --}}
<div class="container">
    <h2>Adicionar Novo Competidor</h2>
    <p><a href="{{ route('smash.index') }}">← Voltar para a Votação</a></p>

    <form method="POST" action="{{ route('persons.store') }}" enctype="multipart/form-data">
        @csrf 

        <p>
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}">
        </p>

        <p>
            <label for="image">Foto (Máx. 2MB, JPG/PNG):</label>
            <input type="file" name="image" id="image" required>
        </p>
        
        {{-- Usamos a estilização de erros do CSS --}}
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- O CSS agora estiliza o botão sem estilos inline --}}
        <button type="submit">Salvar Pessoa</button>
        
    </form>
</div>

{{-- Adiciona o script JS para o efeito de "Processando..." no botão --}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>