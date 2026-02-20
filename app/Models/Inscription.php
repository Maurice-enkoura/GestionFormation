<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'user_id',
        'date_inscription',
        'statut',
        'progression'
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
