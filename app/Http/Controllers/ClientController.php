<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Interfaces\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index() {
        $sort = ['users.id', 'users.email', 'people.first_name', 'people.last_name', 'people.pesel', 'people.phone'];
        $filter = ['users.id', 'users.email', 'people.first_name', 'people.last_name', 'people.pesel', 'people.phone'];
        return UserResource::collection(
            $this->clientRepository->getAllPaginated(request()->per_page ?? 15, $sort, $filter)
        );
    }
}
