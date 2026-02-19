<?php
// app/Http/Controllers/Apprenant/ProfilController.php

namespace App\Http\Controllers\Apprenant;

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
        return view('apprenant.profil.index', compact('user'));
    }
    
    /**
     * Mettre à jour le profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'telephone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
        ]);
        
        $user->update($request->only('nom', 'email', 'telephone', 'bio'));
        
        return redirect()->route('apprenant.profil')
            ->with('success', 'Profil mis à jour avec succès.');
    }
    
    /**
     * Afficher les paramètres
     */
    public function settings()
    {
        $user = Auth::user();
        return view('apprenant.parametres.index', compact('user'));
    }
    
    /**
     * Mettre à jour les paramètres (mot de passe, etc.)
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        
        return redirect()->route('apprenant.parametres')
            ->with('success', 'Mot de passe mis à jour avec succès.');
    }
}