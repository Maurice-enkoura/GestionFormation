<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Module;
use App\Models\Inscription;
use App\Models\Evaluation;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'formateur_id',
        'date_debut',
        'date_fin'
    ];

    // 🔹 Dire à Laravel que ces champs sont des dates
    protected $casts = [
    'date_debut' => 'date',
    'date_fin'   => 'date',
];

    // Relation avec formateur
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    // Relation avec les modules
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    // Relation avec les inscriptions
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    // Apprenants inscrits
    public function apprenants()
    {
        return $this->belongsToMany(User::class, 'inscriptions', 'formation_id', 'user_id');
    }

    /**
     * Évaluations de la formation
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Note moyenne de la formation
     */
    public function getNoteMoyenneAttribute()
    {
        return $this->evaluations()->where('est_publiee', true)->avg('note') ?? 0;
    }

    /**
     * Nombre total d'évaluations
     */
    public function getTotalEvaluationsAttribute()
    {
        return $this->evaluations()->where('est_publiee', true)->count();
    }

    /**
     * Distribution des notes (pour les graphiques)
     */
    public function getDistributionNotesAttribute()
    {
        $distribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $distribution[$i] = $this->evaluations()
                ->where('est_publiee', true)
                ->where('note', $i)
                ->count();
        }
        return $distribution;
    }


}
