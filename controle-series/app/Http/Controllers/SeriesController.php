<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    function index(Request $request)
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
        $series = Series::create($request->all());
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $season = $series->seasons()->create(['number' => $i]);

            for ($j = 1; $j <= $request->episodes; $j++) {
                $season->episodes()->create(['number' => $j]);
            }
        }

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
