<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;

class PointDemoController extends Controller
{
    // Strona z formularzem i listą punktów
    public function index()
    {
        $points = Point::orderBy('id', 'desc')->take(20)->get();
        return view('points_demo', compact('points'));
    }

    // Zapis nowego rekordu z formularza
    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|integer',
            'client_id' => 'required|integer',
            'receipt_number' => 'required|string|max:255',
            'amount_spent' => 'required|numeric',
        ]);

        // Zapis z automatycznym przeliczeniem punktów (jeśli masz boot() w modelu)
        $point = Point::create([
            'company_id' => $data['company_id'],
            'client_id' => $data['client_id'],
            'receipt_number' => $data['receipt_number'],
            'amount_spent' => $data['amount_spent'],
        ]);

        return redirect()->back()->with('success', 'Dodano punkty! ID rekordu: ' . $point->id);
    }
}
