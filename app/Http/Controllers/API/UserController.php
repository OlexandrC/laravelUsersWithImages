<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withCount('images')
            ->orderBy('images_count', 'desc')
            ->get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
        ]);
    
        $user = User::firstOrCreate(
            ['email' => $validatedData['email'] ?? fake()->safeEmail()],
            [
                'name' => $validatedData['name'],
                'city' => $validatedData['city'],
                'password' => bcrypt('password'),
            ]
        );
    
        $user->images()->create(['image' => $request->input('image')]);
    
        return response()->json($user->load('images'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
