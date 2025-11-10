<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class GetEventController extends Controller
{
    public function index()
    {
        return response()->json([
            'events' => Event::all(),
        ], 200);
    }
}
