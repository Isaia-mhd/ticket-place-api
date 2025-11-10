<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterOrganizerRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegisterOrganizerController extends Controller
{
    public function store(RegisterOrganizerRequest $request)
    {
        if(Gate::denies('is_super_admin'))
        {
            return response()->json([
                'message' => 'Action refusé.'
            ], 403);
        }
        
        $data = $request->validated();
        $organizer = User::create([
            ...$data,
            'password' => Hash::make($data['password']),
            'role' => 'organizer'
        ]);

        return response()->json([
            'message' => 'Compte organisateur créé avec succès.',
            'organizer' => $organizer
        ]);
    }
}
