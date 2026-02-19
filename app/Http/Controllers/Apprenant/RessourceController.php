<?php
// app/Http/Controllers/Apprenant/RessourceController.php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Inscription;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RessourceController extends Controller
{
    /**
     * Afficher la liste des ressources (contenus)
     */
    public function index()
    {
        $apprenant = Auth::user();
        
        // Récupérer les IDs des formations auxquelles l'apprenant est inscrit
        $formationsIds = Inscription::where('user_id', $apprenant->id)
            ->pluck('formation_id');
        
        // Récupérer les IDs des modules de ces formations
        $modulesIds = Module::whereIn('formation_id', $formationsIds)
            ->pluck('id');
        
        // Récupérer les contenus avec leurs modules et formations
        $contenus = Contenu::whereIn('module_id', $modulesIds)
            ->with(['module.formation'])
            ->latest()
            ->paginate(12);
        
        return view('apprenant.ressources.index', compact('contenus'));
    }
    
    /**
     * Télécharger/accéder à une ressource
     */
    public function download($id)
    {
        $contenu = Contenu::with('module.formation')->findOrFail($id);
        
        // Vérifier que l'apprenant a accès à ce contenu
        $aAcces = Inscription::where('user_id', Auth::id())
            ->where('formation_id', $contenu->module->formation_id)
            ->exists();
            
        if (!$aAcces) {
            abort(403, 'Vous n\'avez pas accès à cette ressource.');
        }
        
        // Rediriger vers l'URL du contenu
        return redirect($contenu->url);
    }
}