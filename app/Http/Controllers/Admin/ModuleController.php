<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Formation;
use App\Models\Contenu;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, Formation $formation)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $module = $formation->modules()->create($validated);
        
        return response()->json([
            'success' => true,
            'module' => $module,
            'message' => 'Module ajouté avec succès.'
        ]);
    }
    
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $module->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Module modifié avec succès.'
        ]);
    }
    
    public function destroy(Module $module)
    {
        $module->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Module supprimé avec succès.'
        ]);
    }
}

class ContenuController extends Controller
{
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate([
            'type' => 'required|in:video,document',
            'url' => 'required|string|url',
            'description' => 'nullable|string',
        ]);
        
        $contenu = $module->contenus()->create($validated);
        
        return response()->json([
            'success' => true,
            'contenu' => $contenu,
            'message' => 'Contenu ajouté avec succès.'
        ]);
    }
    
    public function update(Request $request, Contenu $contenu)
    {
        $validated = $request->validate([
            'type' => 'required|in:video,document',
            'url' => 'required|string|url',
            'description' => 'nullable|string',
        ]);
        
        $contenu->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Contenu modifié avec succès.'
        ]);
    }
    
    public function destroy(Contenu $contenu)
    {
        $contenu->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Contenu supprimé avec succès.'
        ]);
    }
}