<x-layout title="Séries">
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item">{{ $serie->nome }}</li>
        @endforeach
    </ul>

    <a href="/series/create" class="btn btn-dark mt-2">Adicionar série</a>
</x-layout>
