<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParticipantResource;
use App\Http\Resources\UserResource;
use App\Interfaces\ParticipantRepository;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private ParticipantRepository $participantRepository;

    public function __construct(ParticipantRepository $participantRepository) {
        $this->participantRepository = $participantRepository;
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login() {
        $credientials = request(['email', 'password']);
        $ttl = $this->getTTL();

        if(!$token = auth()->attempt($credientials)) return response()->json(['error' => 'Unauthorized'], 401);

        return $this->respondWithToken($token, $ttl);
    }

    public function me() {
        return new UserResource(auth()->user());
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh(), $this->getTTL());
    }

    protected function respondWithToken($token, $ttl) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl,
        ]);
    }

    /**
     * @return mixed
     */
    private function getTTL(): mixed {
        return request('remember_me') ? env('JWT_REMEMBER_TTL') : env('JWT_TTL');
    }

    public function getAllParticipants() {
        return ParticipantResource::collection(
            $this->participantRepository->getAllByPayerId(auth()->user()->id)->filter(function($participant) {
                return $participant->person->id !== auth()->user()->person->id;
            })
        );
    }
}
