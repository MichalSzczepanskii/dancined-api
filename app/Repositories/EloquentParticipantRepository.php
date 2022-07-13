<?php

namespace App\Repositories;

use App\Models\Participant;

class EloquentParticipantRepository implements \App\Interfaces\ParticipantRepository {

    public function getAllByPayerId($payerId) {
        return Participant::where('payer_id', $payerId)->get();
    }
}