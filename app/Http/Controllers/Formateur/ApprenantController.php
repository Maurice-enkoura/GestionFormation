<?php
// app/Http/Controllers/Formateur/ApprenantController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inscription;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprenantController extends Controller
{
    /**
     * Afficher la liste des apprenants inscrits aux formations du formateur
     */
    public function index(Request $request)
    {
        $formateur = Auth::user();
        
        // Récupérer les IDs des formations du formateur
        $formationsIds = Formation::where('formateur_id', $formateur->id)
            ->pluck('id');
        
        // Récupérer les apprenants inscrits à ces formations
        $query = User::where('role', 'apprenant')
            ->whereHas('inscriptions', function($q) use ($formationsIds) {
                $q->whereIn('formation_id', $formationsIds);
            })
            ->withCount(['inscriptions' => function($q) use ($formationsIds) {
                $q->whereIn('formation_id', $formationsIds);
            }]);
        
        // Recherche
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }
        
        $apprenants = $query->latest()->paginate(15);
        
        return view('formateur.apprenants.index', compact('apprenants'));
    }

    /**
     * Afficher les détails d'un apprenant
     */
    public function show(User $apprenant)
    {
        $formateur = Auth::user();
        
        // Vérifier que l'apprenant est inscrit à une formation de ce formateur
        $formationsIds = Formation::where('formateur_id', $formateur->id)
            ->pluck('id');
        
        $inscriptions = Inscription::where('user_id', $apprenant->id)
            ->whereIn('formation_id', $formationsIds)
            ->with('formation')
            ->get();
        
        if ($inscriptions->isEmpty()) {
            abort(403, 'Cet apprenant n\'est pas inscrit à vos formations.');
        }
        
        $stats = [
            'total_formations' => $inscriptions->count(),
            'formations_terminees' => $inscriptions->where('statut', 'termine')->count(),
            'formations_en_cours' => $inscriptions->where('statut', 'en_cours')->count(),
        ];
        
        return view('formateur.apprenants.show', compact('apprenant', 'inscriptions', 'stats'));
    }
}