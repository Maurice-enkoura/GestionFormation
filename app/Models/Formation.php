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
        'date_fin',
        'est_active',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
    ];

    /* ================= RELATIONS ================= */

    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function apprenants()
    {
        return $this->belongsToMany(User::class, 'inscriptions', 'formation_id', 'user_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /* ================= MÉTHODES MÉTIER (SAFE) ================= */

    // ✅ appelé seulement si nécessaire
    public function noteMoyenne()
    {
        return $this->evaluations()
            ->where('est_publiee', true)
            ->avg('note') ?? 0;
    }

    public function totalEvaluations()
    {
        return $this->evaluations()
            ->where('est_publiee', true)
            ->count();
    }

    public function distributionNotes()
    {
        return $this->evaluations()
            ->where('est_publiee', true)
            ->selectRaw('note, COUNT(*) as total')
            ->groupBy('note')
            ->pluck('total', 'note')
            ->toArray();
    }
}