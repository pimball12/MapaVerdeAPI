<?php

namespace App\Http\Controllers;

use App\Http\Requests\GardenStoreRequest;
use App\Http\Requests\GardenUpdateRequest;
use App\Http\Resources\GardenCollection;
use App\Http\Resources\GardenResource;
use App\Models\Garden;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;

class GardenController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $gardens = QueryBuilder::for(Garden::class)
            ->paginate();

        return new GardenCollection($gardens);
    }

    public function store(GardenStoreRequest $request)
    {
        $validated = $request->validated();

        $garden = Auth::user()->owned_gardens()->create($validated);

        return new GardenResource($garden);
    }

    public function update(GardenUpdateRequest $request, Garden $garden)
    {
        $validated = $request->validated();

        $garden->update($validated);

        return new GardenResource($garden);
    }

    public function show(Request $request, Garden $garden)
    {
        return new GardenResource($garden->load(['owner', 'main_picture']));
    }

    public function destroy(Request $request, Garden $garden)
    {
        $garden->delete();

        return response()->noContent();
    }
}
