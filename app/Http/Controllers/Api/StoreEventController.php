<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class StoreEventController extends Controller
{
     public function store(EventRequest $request)
    {
        $data = $request->validated();

        // add the owner automated.
        $data['user_id'] = auth()->id();

        // Manage image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        // Store the event
        $event = Event::create($data);

        return response()->json([
            'message' => "Événement créé avec succès",
            'event' => $event
        ], 201);
    }
}
