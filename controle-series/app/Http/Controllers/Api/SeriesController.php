<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use Illuminate\Contracts\Auth\Authenticatable;

class SeriesController extends Controller
{
    public function __construct(
        private SeriesRepository $seriesRepository
    ) {}

    public function index(Request $request)
    {
        $nome = $request->query('nome');
        if ($nome) {
            return Series::where('nome', 'like', "%$nome%")->get();
        }
        return Series::paginate();
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->seriesRepository->add($request);
        SeriesCreatedEvent::dispatch(
            $series->nome,
            $series->id,
            $request->seasonsQty,
            $request->episodes
        );
        return response()->json($series, 201);
    }

    public function show(int $id)
    {
        $series = Series::with('seasons.episodes')->find($id);
        if (is_null($series)) {
            return response()->json(null, 404);
        }
        return response()->json($series);
    }

    public function update(SeriesFormRequest $request, Series $series)
    {
        $series->fill($request->all());
        $series->save();
        return response()->json($series, 200);
    }

    public function destroy(int $id, Authenticatable $user)
    {
        if ($user->tokenCan('series:delete')){
            Series::destroy($id);
            return response()->json(null, 204);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
