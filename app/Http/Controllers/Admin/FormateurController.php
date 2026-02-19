<?php
// app/Http/Controllers/Admin/FormateurController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    /**
     * Affiche la liste des formateurs
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'formateur');
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $formateurs = $query->withCount('formations')->latest()->paginate(15);
        
        // Calculer les statistiques
        $stats = [
            'total' => User::where('role', 'formateur')->count(),
            'formations_total' => Formation::whereIn('formateur_id', $formateurs->pluck('id'))->count(),
            'actifs' => User::where('role', 'formateur')
                        ->where('created_at', '>=', now()->subDays(30))
                        ->count(),
        ];
        
        return view('admin.formateurs.index', compact('formateurs', 'stats'));
    }

    /**
     * Affiche les détails d'un formateur
     */
    public function show(User $formateur)
    {
        if ($formateur->role !== 'formateur') {
            abort(404);
        }
        
        $formateur->load(['formations' => function($query) {
            $query->withCount('inscriptions');
        }]);
        
        // Statistiques supplémentaires
        $stats = [
            'total_formations' => $formateur->formations->count(),
            'total_inscriptions' => $formateur->formations->sum('inscriptions_count'),
            'derniere_formation' => $formateur->formations()->latest()->first(),
        ];
        
        return view('admin.formateurs.show', compact('formateur', 'stats'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(User $formateur)
    {
        if ($formateur->role !== 'formateur') {
            abort(404);
        }
        
        return view('admin.formateurs.edit', compact('formateur'));
    }

    /**
     * Met à jour un formateur
     */
    public function update(Request $request, User $formateur)
    {
        if ($formateur->role !== 'formateur') {
            abort(404);
        }
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $formateur->id,
            'specialite' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);
        
        $formateur->update($validated);
        
        return redirect()->route('admin.formateurs.index')
            ->with('success', 'Formateur modifié avec succès.');
    }

    /**
     * Supprime un formateur
     */
    public function destroy(User $formateur)
    {
        if ($formateur->role !== 'formateur') {
            abort(404);
        }
        
        $formateur->delete();
        
        return redirect()->route('admin.formateurs.index')
            ->with('success', 'Formateur supprimé avec succès.');
    }
}