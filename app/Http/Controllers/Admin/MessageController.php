<?php
// app/Http/Controllers/Admin/MessageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Liste des messages
     */
    public function index(Request $request)
    {
        $query = Message::with(['sender', 'receiver']);
        
        // Filtre par recherche
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('contenu', 'like', '%' . $request->search . '%')
                  ->orWhere('sujet', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filtre par utilisateur
        if ($request->filled('user_id')) {
            $query->where('sender_id', $request->user_id)
                  ->orWhere('receiver_id', $request->user_id);
        }
        
        $messages = $query->latest()->paginate(20);
        
        // Statistiques simples
        $stats = [
            'total' => Message::count(),
            'aujourd_hui' => Message::whereDate('created_at', today())->count(),
        ];
        
        // Liste des utilisateurs pour le filtre
        $users = User::orderBy('nom')->get(['id', 'nom', 'role']);
        
        return view('admin.messages.index', compact('messages', 'stats', 'users'));
    }
    
    /**
     * Voir un message
     */
    public function show(Message $message)
    {
        $message->load(['sender', 'receiver']);
        
        return view('admin.messages.show', compact('message'));
    }
    
    /**
     * Supprimer un message
     */
    public function destroy(Message $message)
    {
        $message->delete();
        
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }
}