<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'winner_id',
        'loser_id',
    ];

    public function winner(){
        return $this->belongsTo(Person::class, 'winner_id');
    }

    public function loser(){
        return $this->belongsTo(Person::class, 'loser_id');
    }
}
