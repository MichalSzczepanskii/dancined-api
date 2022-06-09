<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{

    public function index() {
        $query = Room::query();

        if(\request('sort_by'))
            $query->orderBy(\request('sort_by'), \request('sort_order', 'asc'));

        $filters = json_decode(\request('filter'));
        foreach ($filters as $filter){
                $query->where($filter->field, 'LIKE', '%'.$filter->value.'%');
        }

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
