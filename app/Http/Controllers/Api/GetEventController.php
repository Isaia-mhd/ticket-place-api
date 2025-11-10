<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetEventController extends Controller
{
    public function index(Request $request)
    {
         $search = $request->query('search');

        $events = Event::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%")
                    ->orWhereDate('event_date', Carbon::parse($search)->format('Y-m-d'))
                    ->orWhere('type', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return response()->json([
            'events' => $events
        ], 200);
    }
}
