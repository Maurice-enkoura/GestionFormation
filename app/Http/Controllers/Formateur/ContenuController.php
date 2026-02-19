<?php
namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenuController extends Controller
{
    public function store(Request $request, $moduleId)
    {
        $module = Module::findOrFail($moduleId);
        
        // Vérifier que le module appartient à une formation du formateur connecté
        if ($module->formation->formateur_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'type' => 'required|in:video,document',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $contenu = Contenu::create([
            'module_id' => $moduleId,
            'type' => $request->type,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Contenu ajouté avec succès.');
    }

    public function update(Request $request, Contenu $contenu)
    {
        // Vérifier que le contenu appartient à une formation du formateur connecté
        if ($contenu->module->formation->formateur_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'type' => 'required|in:video,document',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $contenu->update($request->only('type', 'url', 'description'));

        return redirect()->back()->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy(Contenu $contenu)
    {
        // Vérifier que le contenu appartient à une formation du formateur connecté
        if ($contenu->module->formation->formateur_id !== Auth::id()) {
            abort(403);
        }

        $contenu->delete();

        return redirect()->back()->with('success', 'Contenu supprimé avec succès.');
    }
}