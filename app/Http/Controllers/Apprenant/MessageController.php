<?php
// app/Http/Controllers/Apprenant/MessageController.php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Afficher la liste des messages
     */
    public function index(Request $request)
    {
        $apprenant = Auth::user();
        
        $query = Message::where('receiver_id', $apprenant->id)
            ->orWhere('sender_id', $apprenant->id)
            ->with(['sender', 'receiver', 'formation']);
        
        if ($request->filled('contact_id')) {
            $query->where(function($q) use ($request) {
                $q->where('sender_id', $request->contact_id)
                  ->orWhere('receiver_id', $request->contact_id);
            });
        }
        
        $messages = $query->latest()->paginate(20);
        
        // Récupérer les contacts uniques (formateurs)
        $contacts = $this->getContacts($apprenant);
        
        // Compter les messages non lus
        $nonLus = Message::where('receiver_id', $apprenant->id)
            ->where('lu', false)
            ->count();
        
        return view('apprenant.messages.index', compact('messages', 'contacts', 'nonLus'));
    }

    /**
     * Afficher le formulaire de nouveau message
     */
    public function create(Request $request)
    {
        $apprenant = Auth::user();
        
        // Récupérer les formateurs des formations auxquelles l'apprenant est inscrit
        $formationsIds = \App\Models\Inscription::where('user_id', $apprenant->id)
            ->pluck('formation_id');
        
        $formateurs = User::where('role', 'formateur')
            ->whereHas('formations', function($q) use ($formationsIds) {
                $q->whereIn('id', $formationsIds);
            })
            ->get();
        
        $formations = \App\Models\Formation::whereIn('id', $formationsIds)->get();
        
        $selectedFormateur = $request->get('formateur_id');
        $selectedFormation = $request->get('formation_id');
        
        return view('apprenant.messages.create', compact('formateurs', 'formations', 'selectedFormateur', 'selectedFormation'));
    }

    /**
     * Envoyer un nouveau message - CORRIGÉ
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'formation_id' => 'nullable|exists:formations,id',
            'sujet' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'formation_id' => $request->formation_id,
            'message' => $request->sujet . "\n\n" . $request->contenu, // Combine sujet et contenu dans le champ 'message'
            'lu' => false
        ]);

        return redirect()->route('apprenant.messages.index')
            ->with('success', 'Message envoyé avec succès.');
    }

    /**
     * Afficher les détails d'un message
     */
    public function show(Message $message)
    {
        $apprenant = Auth::user();
        
        // Vérifier que l'apprenant est concerné par ce message
        if ($message->sender_id != $apprenant->id && $message->receiver_id != $apprenant->id) {
            abort(403);
        }
        
        // Marquer comme lu si nécessaire
        if ($message->receiver_id == $apprenant->id && !$message->lu) {
            $message->update(['lu' => true]);
        }
        
        $message->load(['sender', 'receiver', 'formation']);
        
        // Séparer le sujet et le contenu (si stockés ensemble)
        $parts = explode("\n\n", $message->message, 2);
        $sujet = $parts[0] ?? '';
        $contenu = $parts[1] ?? $message->message;
        
        // Récupérer la conversation précédente
        $conversation = Message::where(function($q) use ($message, $apprenant) {
                $q->where('sender_id', $message->sender_id)
                  ->where('receiver_id', $message->receiver_id);
            })
            ->orWhere(function($q) use ($message) {
                $q->where('sender_id', $message->receiver_id)
                  ->where('receiver_id', $message->sender_id);
            })
            ->where('id', '!=', $message->id)
            ->latest()
            ->take(10)
            ->get();
        
        return view('apprenant.messages.show', compact('message', 'conversation', 'sujet', 'contenu'));
    }

    /**
     * Supprimer un message
     */
    public function destroy(Message $message)
    {
        $apprenant = Auth::user();
        
        // Vérifier que l'apprenant est concerné par ce message
        if ($message->sender_id != $apprenant->id && $message->receiver_id != $apprenant->id) {
            abort(403);
        }
        
        $message->delete();
        
        return redirect()->route('apprenant.messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }

    /**
     * Récupérer les contacts uniques
     */
    private function getContacts($user)
    {
        $sentIds = Message::where('sender_id', $user->id)
            ->pluck('receiver_id')
            ->unique()
            ->toArray();
            
        $receivedIds = Message::where('receiver_id', $user->id)
            ->pluck('sender_id')
            ->unique()
            ->toArray();
        
        $contactIds = array_unique(array_merge($sentIds, $receivedIds));
        
        return User::whereIn('id', $contactIds)->get();
    }
}