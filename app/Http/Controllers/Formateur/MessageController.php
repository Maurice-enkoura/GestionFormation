<?php
// app/Http/Controllers/Formateur/MessageController.php

namespace App\Http\Controllers\Formateur;

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
        $formateur = Auth::user();
        
        $query = Message::where('receiver_id', $formateur->id)
            ->orWhere('sender_id', $formateur->id)
            ->with(['sender', 'receiver', 'formation']);
        
        // Filtrer par conversation
        if ($request->filled('contact_id')) {
            $query->where(function($q) use ($request) {
                $q->where('sender_id', $request->contact_id)
                  ->orWhere('receiver_id', $request->contact_id);
            });
        }
        
        $messages = $query->latest()->paginate(20);
        
        // Récupérer les contacts uniques
        $contacts = $this->getContacts($formateur);
        
        // Compter les messages non lus
        $nonLus = Message::where('receiver_id', $formateur->id)
            ->where('lu', false)
            ->count();
        
        return view('formateur.messages.index', compact('messages', 'contacts', 'nonLus'));
    }

    /**
     * Afficher les détails d'un message
     */
    public function show(Message $message)
    {
        $formateur = Auth::user();
        
        // Vérifier que le formateur est concerné par ce message
        if ($message->sender_id != $formateur->id && $message->receiver_id != $formateur->id) {
            abort(403);
        }
        
        // Marquer comme lu si nécessaire
        if ($message->receiver_id == $formateur->id && !$message->lu) {
            $message->update(['lu' => true]);
        }
        
        $message->load(['sender', 'receiver', 'formation']);
        
        return view('formateur.messages.show', compact('message'));
    }

    /**
     * Afficher le formulaire de nouveau message
     */
    public function create(Request $request)
    {
        $formateur = Auth::user();
        
        // Récupérer les apprenants inscrits aux formations du formateur
        $formationsIds = Formation::where('formateur_id', $formateur->id)->pluck('id');
        
        $apprenants = User::where('role', 'apprenant')
            ->whereHas('inscriptions', function($q) use ($formationsIds) {
                $q->whereIn('formation_id', $formationsIds);
            })
            ->get();
        
        $formations = Formation::where('formateur_id', $formateur->id)->get();
        
        $selectedApprenant = $request->get('apprenant_id');
        $selectedFormation = $request->get('formation_id');
        
        return view('formateur.messages.create', compact('apprenants', 'formations', 'selectedApprenant', 'selectedFormation'));
    }

    /**
     * Envoyer un nouveau message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
            'formation_id' => 'nullable|exists:formations,id',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'formation_id' => $request->formation_id,
            'message' => $request->message,
            'lu' => false
        ]);

        return redirect()->route('formateur.messages.index', ['contact_id' => $request->receiver_id])
            ->with('success', 'Message envoyé avec succès.');
    }

    /**
     * Supprimer un message
     */
    public function destroy(Message $message)
    {
        $formateur = Auth::user();
        
        // Vérifier que le formateur est concerné par ce message
        if ($message->sender_id != $formateur->id && $message->receiver_id != $formateur->id) {
            abort(403);
        }
        
        $message->delete();
        
        return redirect()->route('formateur.messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }

    /**
     * Récupérer les contacts uniques
     */
    private function getContacts($formateur)
    {
        $sentIds = Message::where('sender_id', $formateur->id)
            ->pluck('receiver_id')
            ->unique()
            ->toArray();
            
        $receivedIds = Message::where('receiver_id', $formateur->id)
            ->pluck('sender_id')
            ->unique()
            ->toArray();
        
        $contactIds = array_unique(array_merge($sentIds, $receivedIds));
        
        return User::whereIn('id', $contactIds)
            ->select('id', 'nom', 'role')
            ->get();
    }
}