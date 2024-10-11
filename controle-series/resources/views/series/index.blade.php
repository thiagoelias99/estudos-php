<x-layout title="Séries">
    @isset($message)
        <div class="alert alert-success">{{ $message }}</div>
    @endisset

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->nome }}
                <form action="{{ route('series.edit', $serie->id) }}" method="get">
                    @csrf
                    <button class="btn btn-primary btn-sm">UP</button>
                </form>
                <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('series.create') }}" class="btn btn-dark mt-2">Adicionar série</a>
</x-layout>
