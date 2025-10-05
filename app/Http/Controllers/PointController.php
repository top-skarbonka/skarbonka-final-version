<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Formularz dodawania punktów.
     */
    public function create()
    {
        // tylko pokazuje widok formularza
        return view('company.points.create');
    }

    /**
     * Lista punktów (na przyszłość, jeśli dodamy historię)
     */
    public function index()
    {
        return view('company.points.index');
    }

    /**
     * Zapis punktów (na razie tylko testowo)
     */
    public function store(Request $request)
    {
        // tu jeszcze nic nie zapisujemy – tylko potwierdzenie
        return back()->with('success', '✅ Punkty zostały zapisane (testowo).');
    }
}
