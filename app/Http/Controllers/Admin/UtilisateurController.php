<?php
// app/Http/Controllers/Admin/UtilisateurController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class UtilisateurController extends Controller
{
    /**
     * Affiche la liste des utilisateurs
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Filtre par recherche
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filtre par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        // Filtre par statut (si vous avez un champ statut)
        if ($request->filled('statut')) {
            // $query->where('statut', $request->statut);
        }
        
        $utilisateurs = $query->latest()->paginate(15);
        
        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'formateurs' => User::where('role', 'formateur')->count(),
            'apprenants' => User::where('role', 'apprenant')->count(),
        ];
        
        return view('admin.utilisateurs.index', compact('utilisateurs', 'stats'));
    }
    
    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.utilisateurs.create');
    }
    
    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,formateur,apprenant',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        
        User::create($validated);
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }
    
    /**
     * Affiche les détails d'un utilisateur
     */
    public function show(User $user)
    {
        $user->load(['formations' => function($query) {
            $query->withCount('inscriptions');
        }, 'inscriptions.formation']);
        
        return view('admin.utilisateurs.show', compact('user'));
    }
    
    /**
     * Affiche le formulaire d'édition
     */
    public function edit(User $user)
    {
        return view('admin.utilisateurs.edit', compact('user'));
    }
    
    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,formateur,apprenant',
            'password' => 'nullable|min:8|confirmed',
        ]);
        
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }
    
    /**
     * Supprime un utilisateur
     */
    public function destroy(User $user)
    {
        // Empêcher la suppression de son propre compte
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
    
    /**
     * Suspendre un utilisateur
     */
    public function suspendre(User $user)
    {
        // Si vous avez un champ statut
        // $user->update(['statut' => 'suspendu']);
        
        return back()->with('success', 'Utilisateur suspendu avec succès.');
    }
    
    /**
     * Activer un utilisateur
     */
    public function activer(User $user)
    {
        // Si vous avez un champ statut
        // $user->update(['statut' => 'actif']);
        
        return back()->with('success', 'Utilisateur activé avec succès.');
    }
}