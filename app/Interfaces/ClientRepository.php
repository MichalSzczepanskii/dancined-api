<?php
namespace App\Interfaces;

interface ClientRepository {
    public function getAllPaginated($perPage = 15, $sortColumns = [], $filterColumns = []);
}