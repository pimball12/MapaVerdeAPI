<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContributorUpdateRequest;
use App\Http\Requests\ContributorStoreRequest;
use App\Http\Resources\ContributorCollection;
use App\Http\Resources\ContributorResource;
use App\Models\Contributor;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ContributorController extends Controller
{
    public function index()
    {
        $with = [];

        if (isset($_GET['garden']))    {

            $with[] = 'garden';
        }

        if (isset($_GET['user']))    {

            $with[] = 'user';
        }

        $gardens = QueryBuilder::for(Contributor::with($with))
            ->paginate();

        return new ContributorCollection($gardens);
    }

    public function store(ContributorStoreRequest $request)
    {
        $validated = $request->validated();

        $contributor = Contributor::create($validated);

        return new ContributorResource($contributor);
    }

    public function update(ContributorUpdateRequest $request, Contributor $contributor)
    {
        $validated = $request->validated();

        $contributor->update($validated);

        return new ContributorResource($contributor);
    }

    public function show(Request $request, Contributor $contributor)
    {
        if (isset($_GET['garden']))    {

            $contributor->load('garden');
        }

        if (isset($_GET['user']))    {

            $contributor->load('user');
        }

        return new ContributorResource($contributor);
    }

    public function destroy(Request $request, Contributor $contributor)
    {
        $contributor->delete();

        return response()->noContent();
    }
}
