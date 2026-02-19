<?php
namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function store(Request $request, $formationId)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module = Module::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'formation_id' => $formationId,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'module' => $module]);
        }

        return redirect()->back()->with('success', 'Module ajouté avec succès.');
    }

    public function update(Request $request, Module $module)
    {
        // Vérifier que le module appartient à une formation du formateur connecté
        if ($module->formation->formateur_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module->update($request->only('titre', 'description'));

        return redirect()->back()->with('success', 'Module mis à jour avec succès.');
    }

    public function destroy(Module $module)
    {
        // Vérifier que le module appartient à une formation du formateur connecté
        if ($module->formation->formateur_id !== Auth::id()) {
            abort(403);
        }

        $module->delete();

        return redirect()->back()->with('success', 'Module supprimé avec succès.');
    }
}