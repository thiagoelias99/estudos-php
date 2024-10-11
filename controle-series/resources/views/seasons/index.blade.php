<x-layout title="Temporadas de {!! $series->nome !!}">
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Temporada {{ $season->number }}
                <span class="badge bg-secondary">
                    {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('series.create') }}" class="btn btn-dark mt-2">Adicionar série</a>
</x-layout>
