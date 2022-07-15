<?php

namespace App\Repositories;

use App\Interfaces\ClientRepository;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentClientRepository implements ClientRepository
{
    public function getAllPaginated($perPage = 15, $sortColumns = [], $filterColumns = []){
        return QueryBuilder::for(User::class)
            ->select('users.*')
            ->join('people', 'people.id', 'users.person_id')
            ->with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'client');
            })
            ->allowedSorts($sortColumns)
            ->allowedFilters($filterColumns)
            ->paginate($perPage);
    }
}