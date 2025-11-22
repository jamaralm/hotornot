<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Jobs\ProcessVoteJob;

class SmashController extends Controller
{
    public function index()
    {
        $pair = Person::inRandomOrder()->take(2)->get();

        if ($pair->count() < 2) {
            return view('smash.no_data'); 
        }

        return view('smash.index', [
            'pair' => $pair
        ]);
    }

    public function vote(Request $request)
    {
        $validated = $request->validate([
            'winner_id' => 'required|exists:persons,id|different:loser_id',
            'loser_id' => 'required|exists:persons,id',
        ]);

        ProcessVoteJob::dispatch(
            $validated['winner_id'], 
            $validated['loser_id']
        );
        
        return redirect()->route('smash.index')->with('success', 'Voto registrado! Buscando novo par...');
    }

    public function ranking()
    {
    
        $ranking = Person::orderBy('score', 'desc')
                         ->paginate(20);

        return view('smash.ranking', [
            'ranking' => $ranking
        ]);
    }
}