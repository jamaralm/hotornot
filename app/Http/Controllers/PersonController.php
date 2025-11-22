<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function create()
    {
        return view('persons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);
        
        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('persons', 'public');
        }

        Person::create([
            'name' => $validated['name'],
            'image_path' => 'storage/' . $path, 
            'score' => 1000,
            'votes_received' => 0,
        ]);

        return redirect()->route('smash.index')->with('success', 'Nova pessoa adicionada com sucesso!');
    }
}
