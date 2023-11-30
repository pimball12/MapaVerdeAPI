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

    public function index()
    {
        $with = [];

        if (isset($_GET['owner']))  {

            $with[] = 'owner';
        }

        if (isset($_GET['main_picture']))  {

            $with[] = 'main_picture';
        }

        if (isset($_GET['images']))  {

            $with[] = 'images';
        }

        if (isset($_GET['messages']))  {

            $with[] = 'messages';
        }

        if (isset($_GET['contributors']))  {

            $with[] = 'contributors';
        }

        $gardens = QueryBuilder::for(Garden::with($with))->paginate();

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
        return new GardenResource($garden);
    }

    public function destroy(Request $request, Garden $garden)
    {
        $garden->delete();

        return response()->noContent();
    }
}
