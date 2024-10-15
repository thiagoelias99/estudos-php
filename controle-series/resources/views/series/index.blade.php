<x-layout title="Séries">
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <img class="me-3" src="{{ asset('storage/' . $serie->cover) }}" width="100" class="img-thumbnail"
                        alt="" />
                    @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                        {{ $serie->nome }}
                        @auth </a> @endauth
                </div>
                @auth
                    <form action="{{ route('series.edit', $serie->id) }}" method="get">
                        @csrf
                        <button class="btn btn-primary btn-sm">UP</button>
                    </form>
                    <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                @endauth
            </li>
        @endforeach
    </ul>

    <a href="{{ route('series.create') }}" class="btn btn-dark mt-2">Adicionar série</a>
</x-layout>
