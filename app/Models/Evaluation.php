<?php
// app/Models/Evaluation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'user_id',
        'formateur_id',
        'note',
        'commentaire',
        'est_publiee'
    ];

    protected $casts = [
        'est_publiee' => 'boolean',
        'note' => 'integer',
    ];

    /**
     * Relation avec la formation évaluée
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Relation avec l'apprenant qui a évalué
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le formateur évalué
     */
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    /**
     * Scope pour les évaluations publiées
     */
    public function scopePubliees($query)
    {
        return $query->where('est_publiee', true);
    }

    /**
     * Scope pour filtrer par note minimum
     */
    public function scopeNoteMinimum($query, $note)
    {
        return $query->where('note', '>=', $note);
    }

    /**
     * Scope pour filtrer par formation
     */
    public function scopeParFormation($query, $formationId)
    {
        return $query->where('formation_id', $formationId);
    }

    /**
     * Scope pour filtrer par formateur
     */
    public function scopeParFormateur($query, $formateurId)
    {
        return $query->where('formateur_id', $formateurId);
    }

    /**
     * Obtenir les étoiles en texte
     */
    public function getEtoilesAttribute()
    {
        $etoiles = '';
        for ($i = 1; $i <= 5; $i++) {
            $etoiles .= $i <= $this->note ? '★' : '☆';
        }
        return $etoiles;
    }

    /**
     * Obtenir la couleur en fonction de la note
     */
    public function getCouleurNoteAttribute()
    {
        return match(true) {
            $this->note >= 4 => 'success',
            $this->note >= 3 => 'warning',
            default => 'danger',
        };
    }

    /**
     * Vérifier si l'évaluation est positive (4-5 étoiles)
     */
    public function estPositive()
    {
        return $this->note >= 4;
    }

    /**
     * Vérifier si l'évaluation est négative (1-2 étoiles)
     */
    public function estNegative()
    {
        return $this->note <= 2;
    }
}