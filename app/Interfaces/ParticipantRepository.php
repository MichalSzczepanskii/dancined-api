<?php
namespace App\Interfaces;

interface ParticipantRepository {
    public function getAllByPayerId($payerId);
}