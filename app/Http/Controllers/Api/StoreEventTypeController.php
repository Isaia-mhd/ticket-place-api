<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventTypeRequest;
use Illuminate\Http\Request;

class StoreEventTypeController extends Controller
{
    public function store(EventTypeRequest $request)
    {
        $data = $request->validated();

        // Associer automatiquement le type de ticket à l'événement choisi
        // L'organisateur doit être propriétaire de l'événement
        $event = auth()->user()->events()->find($data['event_id']);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => "Vous n'êtes pas autorisé à ajouter des tickets pour cet événement."
            ], 403);
        }

        // Créer le type de ticket
        $ticketType = $event->ticketTypes()->create([
            'type' => $data['type'],
            'price' => $data['price'],
            'quantity' => $data['quantity'] ?? 0,
        ]);
    }
}
