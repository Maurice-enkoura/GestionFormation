<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'formation_id'
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }
}
