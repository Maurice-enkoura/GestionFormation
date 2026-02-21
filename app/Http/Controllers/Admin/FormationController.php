<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{
    /**
     * Affiche la liste des formations 
     */
    public function index(Request $request)
    {
        $query = Formation::with('formateur:id,nom,email')
            ->withCount('modules')
            ->withCount('inscriptions');
        
        // Filtre par recherche
        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }
        
        // Filtre par formateur
        if ($request->filled('formateur_id')) {
            $query->where('formateur_id', $request->formateur_id);
        }
        
        $formations = $query->latest()->paginate(15);
        
        $formateurs = User::where('role', 'formateur')
            ->select('id', 'nom', 'email')
            ->get();
        
        // Statistiques CORRIGÉES (sans est_active)
        $stats = [
            'total' => Formation::count(),
            'publiees' => Formation::count(), 
            'inscriptions' => Formation::withCount('inscriptions')->get()->sum('inscriptions_count'),
        ];
        
        return view('admin.formations.index', compact('formations', 'formateurs', 'stats'));
    }
    
    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $formateurs = User::where('role', 'formateur')
            ->select('id', 'nom')
            ->get();
        return view('admin.formations.create', compact('formateurs'));
    }
    
    /**
     * Enregistre une nouvelle formation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'formateur_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);
        
        $formation = Formation::create($validated);
        
        return redirect()->route('admin.formations.edit', $formation)
            ->with('success', 'Formation créée avec succès.');
    }
    
    /**
     * Affiche les détails d'une formation
     */
    public function show(Formation $formation)
    {
        $formation->load([
            'formateur:id,nom,email',
            'modules' => function($query) {
                $query->withCount('contenus');
            },
            'inscriptions.user:id,nom,email'
        ]);
        
        $stats = [
            'total_inscrits' => $formation->inscriptions_count ?? $formation->inscriptions->count(),
            'progression_moyenne' => $this->calculerProgressionMoyenne($formation),
            'nombre_modules' => $formation->modules->count(),
            'nombre_contenus' => $formation->modules->sum('contenus_count'),
        ];
        
        return view('admin.formations.show', compact('formation', 'stats'));
    }
    
    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Formation $formation)
    {
        $formation->loadCount('modules');
        $formateurs = User::where('role', 'formateur')
            ->select('id', 'nom')
            ->get();
        
        return view('admin.formations.edit', compact('formation', 'formateurs'));
    }
    
    /**
     * Met à jour une formation
     */
    public function update(Request $request, Formation $formation)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'formateur_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);
        
        $formation->update($validated);
        
        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation modifiée avec succès.');
    }
    
    /**
     * Supprime une formation
     */
    public function destroy(Formation $formation)
    {
        // Supprimer d'abord les inscriptions, modules et contenus (cascade)
        $formation->delete();
        
        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }
    
    /**
     * Active une formation - Commenté en attendant la colonne
     */
    /*
    public function activer(Formation $formation)
    {
        $formation->update(['est_active' => true]);
        
        return redirect()->back()
            ->with('success', 'Formation activée avec succès.');
    }
    */
    
    /**
     * Désactive une formation - Commenté en attendant la colonne
     */
    /*
    public function desactiver(Formation $formation)
    {
        $formation->update(['est_active' => false]);
        
        return redirect()->back()
            ->with('success', 'Formation désactivée avec succès.');
    }
    */
    
    /**
     * Affiche les statistiques d'une formation
     */
    public function statistiques(Formation $formation)
    {
        $formation->loadCount('inscriptions');
        
        // Statistiques des inscriptions par mois
        $inscriptionsParMois = $formation->inscriptions()
            ->select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->keyBy('mois');
        
        // Préparer les données pour le graphique (12 mois)
        $mois = [];
        $donnees = [];
        for ($i = 1; $i <= 12; $i++) {
            $mois[] = $this->getMoisEnLettres($i);
            $donnees[] = $inscriptionsParMois[$i]->total ?? 0;
        }
        
        $stats = [
            'total_inscrits' => $formation->inscriptions_count,
            'taux_completion' => $this->calculerTauxCompletion($formation),
            'progression_modules' => $formation->modules->map(function($module) {
                return [
                    'titre' => $module->titre,
                    'completion' => rand(60, 100) // À remplacer par vraies données
                ];
            }),
            'inscriptions_mensuelles' => [
                'labels' => $mois,
                'data' => $donnees
            ],
        ];
        
        return view('admin.formations.statistiques', compact('formation', 'stats'));
    }
    
    /**
     * Calcule la progression moyenne des apprenants
     */
    private function calculerProgressionMoyenne(Formation $formation)
    {
        // À implémenter selon votre logique
        return 75;
    }
    
    /**
     * Calcule le taux de complétion
     */
    private function calculerTauxCompletion(Formation $formation)
    {
        $totalInscrits = $formation->inscriptions()->count();
        if ($totalInscrits == 0) return 0;
        
        $termines = $formation->inscriptions()
            ->where('statut', 'termine')
            ->count();
            
        return round(($termines / $totalInscrits) * 100);
    }
    
    /**
     * Convertit le numéro du mois en lettres
     */
    private function getMoisEnLettres($mois)
    {
        $moisListe = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Aoû',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];
        return $moisListe[$mois] ?? '';
    }
}