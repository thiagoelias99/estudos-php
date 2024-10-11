<x-layout title="Editar">
    <form action="{{ route('series.update', $series->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da série:</label>
            <input type="text" name="nome" id="nome" placeholder="Nome da série" class="form-control"
                value="{{ $series->nome }}" />
            <button type="submit" class="btn btn-primary mt-1">Salvar</button>
        </div>
    </form>
    <a href="{{ route('series.index') }}" class="btn btn-dark">Voltar</a>
</x-layout>
