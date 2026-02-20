<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Module;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // Statistiques générales
        $totalUsers = User::count();
        $totalFormations = Formation::count();
        $totalFormateurs = User::where('role', 'formateur')->count();
        $totalApprenants = User::where('role', 'apprenant')->count();
        
        // Revenus mensuels (simulés - à adapter selon votre logique de paiement)
        $revenusMensuels = Inscription::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count() * 199; // Prix moyen estimé
        
        // Derniers utilisateurs
        $derniersUtilisateurs = User::latest()->take(5)->get();
        
        // Dernières formations
        $dernieresFormations = Formation::with('formateur')
            ->latest()
            ->take(4)
            ->get();
        
        // Activité récente
        $activiteRecente = $this->getActiviteRecente();
        
        // Données pour les graphiques
        $inscriptionsMensuelles = $this->getInscriptionsMensuelles();
        $repartitionRoles = [
            User::where('role', 'apprenant')->count(),
            User::where('role', 'formateur')->count(),
            User::where('role', 'admin')->count()
        ];
        
        // Statistiques pour les cartes
        $stats = [
            'utilisateurs_actifs' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'nouveaux_aujourdhui' => User::whereDate('created_at', today())->count(),
            'taux_engagement' => $this->calculerTauxEngagement(),
            'total_users' => $totalUsers,
            'total_formations' => $totalFormations,
            'total_formateurs' => $totalFormateurs,
            'revenus_mensuels' => $revenusMensuels
        ];
        
        return view('admin.dashboard', compact(
            'stats',
            'derniersUtilisateurs',
            'dernieresFormations',
            'activiteRecente',
            'inscriptionsMensuelles',
            'repartitionRoles'
        ));
    }
    
    private function getActiviteRecente()
    {
        $activite = collect();
        
        // Nouvelles inscriptions
        $inscriptions = Inscription::with('user', 'formation')
            ->latest()
            ->take(2)
            ->get()
            ->map(function($item) {
                return [
                    'icon' => 'person-plus',
                    'titre' => 'Nouvelle inscription',
                    'description' => $item->user->nom . ' s\'est inscrit à ' . $item->formation->titre,
                    'time' => $item->created_at->diffForHumans(),
                    'type' => 'inscription'
                ];
            });
        
        // Nouvelles formations
        $formations = Formation::with('formateur')
            ->latest()
            ->take(2)
            ->get()
            ->map(function($item) {
                return [
                    'icon' => 'book',
                    'titre' => 'Nouvelle formation créée',
                    'description' => $item->formateur->nom . ' a ajouté "' . $item->titre . '"',
                    'time' => $item->created_at->diffForHumans(),
                    'type' => 'formation'
                ];
            });
        
        // Nouveaux utilisateurs
        $users = User::latest()
            ->take(2)
            ->get()
            ->map(function($item) {
                return [
                    'icon' => 'person',
                    'titre' => 'Nouvel utilisateur',
                    'description' => $item->nom . ' a rejoint la plateforme',
                    'time' => $item->created_at->diffForHumans(),
                    'type' => 'user'
                ];
            });
        
        return $activite->concat($inscriptions)
            ->concat($formations)
            ->concat($users)
            ->sortByDesc(function($item) {
                return strtotime(str_replace(['Il y a ', 'min', 'h', 'j'], '', $item['time']));
            })
            ->take(5)
            ->values();
    }
    
    private function getInscriptionsMensuelles()
    {
        $inscriptions = Inscription::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('mois')
        ->orderBy('mois')
        ->get()
        ->keyBy('mois');
        
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $inscriptions->has($i) ? $inscriptions[$i]->total : rand(50, 200); // Données aléatoires pour l'exemple
        }
        
        return $data;
    }
    
    private function calculerTauxEngagement()
    {
        $totalUsers = User::where('role', 'apprenant')->count();
        if ($totalUsers == 0) return 0;
        
        $usersActifs = Inscription::where('created_at', '>=', now()->subDays(30))
            ->distinct('user_id')
            ->count('user_id');
            
        return round(($usersActifs / $totalUsers) * 100);
    }
    

    public function statistiques()
{
    // Totaux principaux
    $totalUsers = User::count();
    $totalFormations = Formation::count();
    $totalInscriptions = Inscription::count();
    $totalModules = Module::count();
    $totalContenus = Contenu::count();

    // Répartition des rôles
    $repartitionRoles = [
        'apprenants' => User::where('role', 'apprenant')->count(),
        'formateurs' => User::where('role', 'formateur')->count(),
        'admins' => User::where('role', 'admin')->count(),
    ];

    // Inscriptions par mois (année en cours)
    $inscriptionsParMois = Inscription::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('mois')
        ->orderBy('mois')
        ->pluck('total', 'mois')
        ->toArray();

    // Compléter les mois vides
    $dataMensuelle = [];
    for ($i = 1; $i <= 12; $i++) {
        $dataMensuelle[] = $inscriptionsParMois[$i] ?? 0;
    }

    return view('admin.statistiques', [
        'totalUsers' => $totalUsers,
        'totalFormations' => $totalFormations,
        'totalInscriptions' => $totalInscriptions,
        'totalModules' => $totalModules,
        'totalContenus' => $totalContenus,
        'repartitionRoles' => $repartitionRoles,
        'dataMensuelle' => $dataMensuelle
    ]);
}

public function parametres()
{
    // Exemple : récupérer les paramètres généraux de la plateforme
    $parametres = [
        'nom_site' => config('app.name'),
        'email_support' => 'support@example.com',
        'langue_par_defaut' => 'fr',
        'theme' => 'light'
    ];

    return view('admin.parametres', compact('parametres'));
}
}