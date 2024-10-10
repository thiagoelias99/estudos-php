<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        return view('series.index',)
            ->with('series', $series);
    }

    function create()
    {
        return view('series.create');
    }

    function store(Request $request)
    {
        $nome = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nome;
        $serie->save();

        return redirect('/series');
    }
}
