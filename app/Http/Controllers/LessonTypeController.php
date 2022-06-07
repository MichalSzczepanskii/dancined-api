<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonType\LessonTypeRequest;
use App\Http\Resources\LessonTypeResource;
use App\Models\LessonType;
use Illuminate\Http\Request;

class LessonTypeController extends Controller
{

    public function index() {
        $query = LessonType::query();

        if(\request('sort_by'))
            $query->orderBy(\request('sort_by'), \request('sort_order', 'asc'));

        $filters = json_decode(\request('filter'));
        foreach ($filters as $filter)
            $query->where($filter->field, 'LIKE', '%'.$filter->value.'%');

        return LessonTypeResource::collection(
            $query->paginate(request()->per_page ?? 15)
        );
    }

    public function store(LessonTypeRequest $request) {
        LessonType::create($request->validated());
        return response()->json();
    }

    public function delete($id) {
        $lessonType = LessonType::findOrFail($id);
        if($lessonType) $lessonType->delete();
        else return response()->json(null, 400);
        return response()->json();
    }

    public function update(LessonType $lessonType, LessonTypeRequest $request) {
        $lessonType->update($request->validated());
        return response()->json();
    }
}
