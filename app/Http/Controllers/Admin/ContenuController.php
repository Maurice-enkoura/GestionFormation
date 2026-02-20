<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Module;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    // L'admin peut voir les contenus
    public function index(Module $module)
    {
        $contenus = $module->contenus;
        return view('admin.contenus.index', compact('module', 'contenus'));
    }
    
    // Bloquer les actions de modification
    public function store(Request $request, Module $module)
    {
        return redirect()->back()
            ->with('error', 'Seuls les formateurs peuvent créer des contenus pédagogiques.');
    }
}