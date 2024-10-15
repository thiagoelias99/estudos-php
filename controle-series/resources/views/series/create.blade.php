<x-layout title="Cadastro">
    <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome da série:</label>
                <input autofocus type="text" name="nome" value="{{ old('nome') }}" id="nome"
                    placeholder="Nome da série" class="form-control" />
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Temporadas</label>
                <input type="text" name="seasonsQty" value="{{ old('seasonsQty') }}" id="seasonsQty"
                    placeholder="Nome da série" class="form-control" />
            </div>
            <div class="col-2">
                <label for="episodes" class="form-label">Epsódios</label>
                <input type="text" name="episodes" value="{{ old('episodes') }}" id="episodes"
                    placeholder="Nome da série" class="form-control" />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Capa</label>
                <input type="file" id="cover" name="cover" class="form-control"
                    accept="image/gif, image/jpeg, image/png">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-1">Adicionar</button>
    </form>
    <a href="{{ route('series.index') }}" class="btn btn-dark">Voltar</a>
</x-layout>
