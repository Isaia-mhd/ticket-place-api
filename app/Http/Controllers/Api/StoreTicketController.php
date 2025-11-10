<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Str;

class StoreTicketController extends Controller
{
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();

        $ticketType = TicketType::find($data['ticket_type_id']);

        if (!$ticketType) {
            return response()->json([
                'success' => false,
                'message' => "Type de ticket introuvable."
            ], 404);
        }

        $quantity = $data['quantity'] ?? 1;

        // Vérifier la disponibilité
        if ($quantity > $ticketType->quantity) {
            return response()->json([
                'success' => false,
                'message' => "Quantité demandée supérieure à la disponibilité."
            ], 400);
        }

        $tickets = [];

        for ($i = 0; $i < $quantity; $i++) {
            $tickets[] = Ticket::create([
                'ticket_type_id' => $ticketType->id,
                'user_id' => auth()->id(),
                'code' => Str::uuid(),
                'is_used' => false,
            ]);
        }

        // Décrémenter la quantité disponible
        $ticketType->decrement('quantity', $quantity);

        return response()->json([
            'message' => "Tickets achetés avec succès.",
            'data' => $tickets
        ], 201);
    }
}
