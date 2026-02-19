<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Contenu;
use App\Models\Inscription;
use App\Models\Ressource;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🔹 Création de l'admin fixe
        User::factory()->create([
            'nom' => 'Admin Test',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // 🔹 Création des formateurs et apprenants
        $formateurs = User::factory(5)->create(['role' => 'formateur']);
        $apprenants = User::factory(20)->create(['role' => 'apprenant']);

        // 🔹 Création des formations (chaque formation a un formateur aléatoire)
        $formations = Formation::factory(10)->create([
            'formateur_id' => $formateurs->random()->id
        ]);

        foreach ($formations as $formation) {

            // 🔹 Création des modules liés à la formation
            $modules = Module::factory(4)->create([
                'formation_id' => $formation->id
            ]);

            // 🔹 Création des contenus pour chaque module
            foreach ($modules as $module) {
                Contenu::factory(3)->create([
                    'module_id' => $module->id
                ]);
            }

            // 🔹 Inscription d’un groupe d’apprenants à la formation
            $apprenantsInscrits = $apprenants->random(rand(5, 10));
            foreach ($apprenantsInscrits as $apprenant) {
                Inscription::factory()->create([
                    'formation_id' => $formation->id,
                    'user_id' => $apprenant->id
                ]);
            }

            // 🔹 Création des ressources pédagogiques pour la formation
            Ressource::factory(5)->create([
                'formation_id' => $formation->id,
                'formateur_id' => $formation->formateur_id
            ]);
        }
    }
}
