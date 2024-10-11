<x-layout title="Cadastro">
    <form action="{{ route('series.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da série:</label>
            <input type="text" name="nome" value="{{ old('nome') }}" id="nome" placeholder="Nome da série"
                class="form-control" />
            <button type="submit" class="btn btn-primary mt-1">Adicionar</button>
        </div>
    </form>
    <a href="{{ route('series.index') }}" class="btn btn-dark">Voltar</a>
</x-layout>
