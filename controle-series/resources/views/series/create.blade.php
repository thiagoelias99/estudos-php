<x-layout title="Cadastro">
    <form action="/series/create" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da série:</label>
            <input type="text" name="nome" id="nome" placeholder="Nome da série" class="form-control" />
            <button type="submit" class="btn btn-primary mt-1">Adicionar</button>
        </div>
    </form>
    <a href="/series" class="btn btn-dark">Voltar</a>
</x-layout>
