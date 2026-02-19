<?php
// app/Models/Message.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'lu',
        'formation_id'
    ];

    protected $casts = [
        'lu' => 'boolean',
    ];

    /**
     * Relation avec l'expéditeur
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relation avec le destinataire
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Relation avec la formation (optionnel)
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Scope pour les messages non lus
     */
    public function scopeNonLus($query)
    {
        return $query->where('lu', false);
    }

    /**
     * Scope pour les messages entre deux utilisateurs
     */
    public function scopeEntre($query, $userId1, $userId2)
    {
        return $query->where(function($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId1)
              ->where('receiver_id', $userId2);
        })->orWhere(function($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId2)
              ->where('receiver_id', $userId1);
        });
    }

    /**
     * Marquer le message comme lu
     */
    public function marquerCommeLu()
    {
        $this->update(['lu' => true]);
    }

    /**
     * Vérifier si le message est pour un utilisateur donné
     */
    public function estPour($userId)
    {
        return $this->receiver_id == $userId;
    }

    /**
     * Vérifier si le message est de la part d'un utilisateur donné
     */
    public function estDe($userId)
    {
        return $this->sender_id == $userId;
    }
}