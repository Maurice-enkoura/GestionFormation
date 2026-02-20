<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Formation;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // L'admin peut voir les modules mais pas les modifier
    public function index(Formation $formation)
    {
        $modules = $formation->modules()->with('contenus')->get();
        return view('admin.modules.index', compact('formation', 'modules'));
    }
    
    // SUPPRIMER les méthodes store, update, destroy
    // Ou les rediriger avec un message d'erreur
    public function store(Request $request, Formation $formation)
    {
        return redirect()->back()
            ->with('error', 'Seuls les formateurs peuvent créer des modules.');
    }
}