<?php
// app/Http/Controllers/Formateur/FormateurDashboardController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurDashboardController extends Controller
{
    public function dashboard()
    {
        $formateur = Auth::user();
        
        // Statistiques du formateur
        $stats = [
            'total_formations' => Formation::where('formateur_id', $formateur->id)->count(),
            'total_modules' => Module::whereIn('formation_id', 
                Formation::where('formateur_id', $formateur->id)->pluck('id')
            )->count(),
            'total_contenus' => Contenu::whereIn('module_id',
                Module::whereIn('formation_id', Formation::where('formateur_id', $formateur->id)->pluck('id'))->pluck('id')
            )->count(),
            'total_apprenants' => 0 // À calculer selon votre logique
        ];
        
        // Dernières formations du formateur
        $dernieresFormations = Formation::where('formateur_id', $formateur->id)
            ->withCount('inscriptions')
            ->latest()
            ->take(5)
            ->get();
        
        return view('formateur.dashboard', compact('stats', 'dernieresFormations'));
    }
}