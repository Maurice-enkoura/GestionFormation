<?php
// app/Http/Controllers/Apprenant/FormationController.php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Module;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    /**
     * Afficher la liste des formations de l'apprenant
     */
    public function index()
    {
        $apprenant = Auth::user();
        
        $inscriptions = Inscription::where('user_id', $apprenant->id)
            ->with('formation.formateur')
            ->latest()
            ->paginate(12);
        
        return view('apprenant.formations.index', compact('inscriptions'));
    }
    
    /**
     * Afficher le détail d'une formation
     */
    public function show($id)
    {
        $formation = Formation::with(['formateur', 'modules.contenus'])->findOrFail($id);
        
        // Vérifier que l'apprenant est inscrit
        $inscription = Inscription::where('user_id', Auth::id())
            ->where('formation_id', $id)
            ->firstOrFail();
        
        // Compter le nombre total de contenus
        $totalContenus = 0;
        foreach ($formation->modules as $module) {
            $totalContenus += $module->contenus->count();
        }
        
        return view('apprenant.formations.show', compact('formation', 'inscription', 'totalContenus'));
    }
    
    /**
     * Continuer la dernière formation
     */
    public function continuer()
    {
        $derniereInscription = Inscription::where('user_id', Auth::id())
            ->with('formation')
            ->where('statut', 'en_cours')
            ->latest()
            ->first();
        
        if (!$derniereInscription) {
            return redirect()->route('apprenant.formations')
                ->with('error', 'Vous n\'avez aucune formation en cours.');
        }
        
        return redirect()->route('apprenant.formation.show', $derniereInscription->formation_id);
    }


public function inscrire($id)
    {
        $user = Auth::user();

        // Vérifier si l'apprenant est déjà inscrit
        $estInscrit = Inscription::where('user_id', $user->id)
            ->where('formation_id', $id)
            ->exists();

        if ($estInscrit) {
            return redirect()->route('apprenant.dashboard')
                ->with('info', 'Vous êtes déjà inscrit à cette formation.');
        }

        // Créer l'inscription
        Inscription::create([
            'user_id' => $user->id,
            'formation_id' => $id,
            'statut' => 'en_cours',
            'date_inscription' => now(), 
        ]);

        return redirect()->route('apprenant.dashboard')
            ->with('success', 'Inscription réussie ! Vous pouvez commencer la formation.');
    }

}