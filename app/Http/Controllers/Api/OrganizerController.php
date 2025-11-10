<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrganizerController extends Controller
{
    public function destroy(Request $request)
    {
        if(Gate::denies('is_super_admin'))
        {
            return response()->json([
                'message' => 'Action refusé.'
            ], 403);
        }
        $request->validate([
            'organizer_id' => 'required|integer|exists:users,id',
        ], [
            'organizer_id.required' => "L'identifiant de l'organisateur est obligatoire.",
            'organizer_id.integer' => "L'identifiant de l'organisateur doit être un nombre entier.",
            'organizer_id.exists' => "L'organisateur sélectionné n'existe pas.",
        ]);

        $organiser = User::where('role', 'organizer')->where('id', $request->organizer_id)->first();
        if(!$organiser)
        {
            return response()->json([
                'message' => 'Organizer not found.'
            ], 404);
        }

        $organiser->delete();

        return response()->json([
            'message' => 'organisateur supprimée avec succès.'
        ], 200);
    }
}
