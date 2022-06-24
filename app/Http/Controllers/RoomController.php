<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class RoomController extends Controller
{

    public function index() {
        $columns = ['rooms.id','rooms.name', 'rooms.description', 'locations.name'];
        $filters = $columns;
        $filters[] = AllowedFilter::exact('locations.id', null, false);
        $query = QueryBuilder::for(Room::class)
            ->select('rooms.*')
            ->join('locations', 'locations.id', 'rooms.location_id')
            ->allowedSorts($columns)
            ->allowedFilters($filters)
            ->defaultSort('rooms.id');

        return RoomResource::collection(
            $query->paginate(request()->per_page ?? 15)
        );
    }

    public function store(RoomRequest $request) {
        Room::create($request->validated());
        return response()->json();
    }

    public function delete($id) {
        $room = Room::findOrFail($id);
        if($room) $room->delete();
        else return response()->json(null, 400);
        return response()->json();
    }

    public function update(Room $room, RoomRequest $request) {
        $room->update($request->validated());
        return response()->json();
    }
}
