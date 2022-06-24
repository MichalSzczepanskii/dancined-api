<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use function PHPUnit\Framework\isNull;

class LocationController extends Controller
{

    public function index() {
        $columns = ['id', 'name', 'description', 'address'];
        $query = QueryBuilder::for(Location::class)
            ->defaultSort('id')
            ->allowedSorts($columns)
            ->allowedFilters($columns);

        return LocationResource::collection(
            $query->paginate(request()->per_page ?? 15)
        );
    }

    public function store(LocationRequest $request) {
        Location::create($request->validated());
        return response()->json();
    }

    public function delete($id) {
        $location = Location::findOrFail($id);
        if($location) $location->delete();
        else return response()->json(null, 400);
        return response()->json();
    }

    public function update(Location $location, LocationRequest $request) {
        $location->update($request->validated());
        return response()->json();
    }

    public function getAllRaw() {
        return LocationResource::collection(
            Location::all()
        );
    }
}
