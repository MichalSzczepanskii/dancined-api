<?php

namespace App\Http\Controllers;

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
}
