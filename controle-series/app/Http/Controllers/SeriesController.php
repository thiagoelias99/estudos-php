<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(
        private SeriesRepository $repository
    ) {}

    function index()
    {
        $series = Series::all();
        $message = session()->get('message');
        return view('series.index',)
            ->with('series', $series)
            ->with('message', $message);
    }

    function create()
    {
        return view('series.create');
    }

    function store(SeriesFormRequest $request)
    {
        $series = $this->repository->add($request);

        return to_route('series.index')
            ->with('message', "Série {$series->nome} adicionada com sucesso");
    }

    function destroy(Series $series, Request $request)
    {
        $series->delete();
        return to_route('series.index')
            ->with('message', "Série {$series->nome} removida com sucesso");
    }

    function edit(Series $series)
    {
        return view('series.edit')
            ->with('series', $series);
    }

    function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
            ->with('message', "Série {$series->nome} atualizada com sucesso");
    }
}
