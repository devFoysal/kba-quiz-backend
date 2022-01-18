<?php

namespace App;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    
    public function participant() {

        return $this->belongsTo(Participant::class,'participantId');
    }
}