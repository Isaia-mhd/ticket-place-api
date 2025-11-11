<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    public function index(Request $request)
    {
         $search = $request->query('search');

        $events = Event::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%")
                    ->orWhereDate('event_date', $search)
                    ->orWhere('type', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return response()->json([
            'events' => $events
        ], 200);
    }

    public function getOne($event)
    {
        $event = Event::find($event);
        if(!$event)
        {
            return response()->json([
                'message' => 'Evènement non trouvée.'
            ], 404);
        }

        return response()->json([
            'event' => $event
        ], 200);
    }

    public function destroy($event)
    {
        $event = Event::find($event);
        if(!$event)
        {
            return response()->json([
                'message' => 'Evènement non trouvée.'
            ], 404);
        }
        if(Gate::denies('owner', $event->user_id))
        {
            return response()->json([
                'message' => 'Action refusée.'
            ], 403);
        }

        $event->delete();
        return response()->json([
            'message' => 'Evènement supprimée avec succès.'
        ], 200);
    }
}
