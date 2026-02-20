<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Liste des évaluations à modérer
     */
    public function index(Request $request)
    {
        $query = Evaluation::with('user', 'formation');
        
        // Filtre par statut
        if ($request->filled('statut')) {
            if ($request->statut === 'en_attente') {
                $query->where('est_publiee', false);
            } elseif ($request->statut === 'publiee') {
                $query->where('est_publiee', true);
            }
        }
        
        $evaluations = $query->latest()->paginate(20);
        
        return view('admin.evaluations.index', compact('evaluations'));
    }
    
    /**
     * Approuver une évaluation
     */
    public function approuver(Evaluation $evaluation)
    {
        $evaluation->update(['est_publiee' => true]);
        
        return redirect()->back()
            ->with('success', 'Évaluation approuvée et publiée.');
    }
    
    /**
     * Rejeter une évaluation
     */
    public function rejeter(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'motif' => 'required|string|max:500'
        ]);
        
        // Optionnel: envoyer un email à l'utilisateur
        $evaluation->delete();
        
        return redirect()->back()
            ->with('success', 'Évaluation rejetée et supprimée.');
    }
    
    /**
     * Voir les détails d'une évaluation
     */
    public function show(Evaluation $evaluation)
    {
        return view('admin.evaluations.show', compact('evaluation'));
    }
}