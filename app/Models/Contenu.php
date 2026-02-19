<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'type',
        'url',
        'description'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
