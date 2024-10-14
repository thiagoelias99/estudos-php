<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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


        // $email = new SeriesCreated(
        //     nomeSerie: $series->nome,
        //     idSerie: $series->id,
        //     qtdTemporadas: $request->seasonsQty,
        //     episodiosPorTemporada: $request->episodes
        // );

        $users = User::all();
        // Mail::to($users)->send($email);

        //Enviando de forma lenta para teste de filas
        $users->each(function (User $user) use ($series, $request) {
            $email = new SeriesCreated(
                nomeSerie: $series->nome,
                idSerie: $series->id,
                qtdTemporadas: $request->seasonsQty,
                episodiosPorTemporada: $request->episodes
            );
            Mail::to($user)->send($email);
            sleep(2.5);
        });





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
