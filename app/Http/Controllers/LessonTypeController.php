<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonType\LessonTypeRequest;
use App\Http\Resources\LessonTypeResource;
use App\Models\LessonType;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class LessonTypeController extends Controller
{

    public function index() {
        $columns = ['id', 'name', 'description'];
        $query = QueryBuilder::for(LessonType::class)
            ->defaultSort('id')
            ->allowedSorts($columns)
            ->allowedFilters($columns);

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
