<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens ,HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Un formateur peut avoir plusieurs formations
    public function formations()
    {
        return $this->hasMany(Formation::class, 'formateur_id');
    }

    // Un apprenant peut avoir plusieurs inscriptions
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    // Formations suivies par l'apprenant via Inscription
    public function formationsSuivies()
    {
        return $this->belongsToMany(Formation::class, 'inscriptions', 'user_id', 'formation_id');
    }
    


// Ajoutez cette méthode dans la classe User
public function ressources()
{
    return $this->hasMany(Ressource::class, 'formateur_id');
}

// Pour les ressources téléchargées par l'apprenant (si vous voulez suivre ça)
public function ressourcesTelechargees()
{
    return $this->belongsToMany(Ressource::class, 'telechargements', 'user_id', 'ressource_id')
                ->withTimestamps();
}

public function messagesEnvoyes()
{
    return $this->hasMany(Message::class, 'sender_id');
}

/**
 * Messages reçus par l'utilisateur
 */
public function messagesRecus()
{
    return $this->hasMany(Message::class, 'receiver_id');
}

/**
 * Tous les messages (envoyés et reçus)
 */
public function tousLesMessages()
{
    return Message::where('sender_id', $this->id)
        ->orWhere('receiver_id', $this->id)
        ->with(['sender', 'receiver'])
        ->latest();
}

/**
 * Messages non lus
 */
public function messagesNonLus()
{
    return $this->messagesRecus()->nonLus();
}

/**
 * Compter les messages non lus
 */
public function countMessagesNonLus()
{
    return $this->messagesRecus()->nonLus()->count();
}

/**
 * Obtenir les conversations uniques
 */
public function conversations()
{
    $sentIds = Message::where('sender_id', $this->id)
        ->pluck('receiver_id')
        ->unique()
        ->toArray();
        
    $receivedIds = Message::where('receiver_id', $this->id)
        ->pluck('sender_id')
        ->unique()
        ->toArray();
    
    $contactIds = array_unique(array_merge($sentIds, $receivedIds));
    
    return User::whereIn('id', $contactIds)->get();
}

/**
 * Évaluations reçues (en tant que formateur)
 */
public function evaluationsRecues()
{
    return $this->hasMany(Evaluation::class, 'formateur_id');
}

/**
 * Évaluations données (en tant qu'apprenant)
 */
public function evaluationsDonnees()
{
    return $this->hasMany(Evaluation::class, 'user_id');
}

/**
 * Note moyenne des évaluations reçues
 */
public function getNoteMoyenneAttribute()
{
    return $this->evaluationsRecues()->where('est_publiee', true)->avg('note') ?? 0;
}

/**
 * Nombre total d'évaluations reçues
 */
public function getTotalEvaluationsAttribute()
{
    return $this->evaluationsRecues()->where('est_publiee', true)->count();
}

/**
 * Pourcentage d'évaluations positives
 */
public function getPourcentagePositifAttribute()
{
    $total = $this->total_evaluations;
    if ($total == 0) return 0;
    
    $positif = $this->evaluationsRecues()
        ->where('est_publiee', true)
        ->where('note', '>=', 4)
        ->count();
    
    return round(($positif / $total) * 100);
}
}
