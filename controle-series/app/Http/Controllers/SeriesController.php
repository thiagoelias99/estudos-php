<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

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
        $series = Serie::create($request->all());
        return to_route('series.index')
            ->with('message', "Série {$series->nome} adicionada com sucesso");
    }

    function destroy(Serie $series, Request $request)
    {
        $series->delete();
        return to_route('series.index')
            ->with('message', "Série {$series->nome} removida com sucesso");
    }

    function edit(Serie $series)
    {
        return view('series.edit')
            ->with('series', $series);
    }

    function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
            ->with('message', "Série {$series->nome} atualizada com sucesso");
    }
}
