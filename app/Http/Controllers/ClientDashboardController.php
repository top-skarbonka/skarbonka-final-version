<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Point;

class ClientDashboardController extends Controller
{
    public function index()
    {
        return view('client.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'client_code' => 'required',
        ]);

        $client = Client::where('client_code', $request->client_code)->first();

        if (!$client) {
            return back()->with('error', 'Nie znaleziono klienta o podanym kodzie!');
        }

        $points = Point::where('client_id', $client->client_code)->sum('points_awarded');

        $history = Point::where('client_id', $client->client_code)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('client.dashboard', compact('client', 'points', 'history'));
    }
}
