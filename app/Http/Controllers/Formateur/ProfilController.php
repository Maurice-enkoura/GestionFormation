<?php
// app/Http/Controllers/Formateur/ProfilController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    /**
     * Afficher le profil
     */
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'formations' => $user->formations()->count(),
            'apprenants' => $user->formations()
                ->withCount('inscriptions')
                ->get()
                ->sum('inscriptions_count'),
        ];
        
        return view('formateur.profil.index', compact('user', 'stats'));
    }

    /**
     * Mettre à jour le profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'telephone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'specialite' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('formateur.profil')
            ->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Afficher les paramètres
     */
    public function settings()
    {
        return view('formateur.parametres.index');
    }

    /**
     * Mettre à jour les paramètres (mot de passe)
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return redirect()->route('formateur.parametres')
            ->with('success', 'Mot de passe mis à jour avec succès.');
    }
}