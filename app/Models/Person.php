<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';

    protected $fillable = [
        'name',
        'image_path', 
        'score',
        'votes_received',
    ];

    protected $casts = [
        'score' => 'float',
        'votes_received' => 'integer',
    ];

    public function votesWon(){
        return $this->hasMany(Vote::class, 'winner_id');
    }

    public function votesLost(){
        return $this->hasMany(Vote::class, 'loser_id');
    }
}
