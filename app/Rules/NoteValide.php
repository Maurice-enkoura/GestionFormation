<?php
// app/Rules/NoteValide.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoteValide implements Rule
{
    public function passes($attribute, $value)
    {
        return is_numeric($value) && $value >= 1 && $value <= 5;
    }

    public function message()
    {
        return 'La note doit être comprise entre 1 et 5.';
    }
}
