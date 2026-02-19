<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FormateurDashboardController extends Controller
{
    public function dashboard()
    {
        $formateur = Auth::user();

        // Exemple simple de stats
        $stats = [
            'total_formations' => $formateur->formations()->count(),
            'total_apprenants' => $formateur->formations()
                ->withCount('inscriptions')
                ->get()
                ->sum('inscriptions_count'),
        ];

        return view('formateur.index', compact('formateur', 'stats'));
    }
}

