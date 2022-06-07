<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class LocationController extends Controller
{

    public function index() {
        $query = Location::query();

        if(\request('sort_by'))
            $query->orderBy(\request('sort_by'), \request('sort_order', 'asc'));

        $filters = json_decode(\request('filter'));
        foreach ($filters as $filter)
            $query->where($filter->field, 'LIKE', '%'.$filter->value.'%');


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
}
