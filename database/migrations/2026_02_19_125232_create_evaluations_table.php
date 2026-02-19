<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_evaluations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // apprenant qui évalue
            $table->foreignId('formateur_id')->constrained('users')->onDelete('cascade'); // formateur évalué
            $table->integer('note')->unsigned()->between(1, 5); // note de 1 à 5
            $table->text('commentaire')->nullable();
            $table->boolean('est_publiee')->default(true);
            $table->timestamps();
            
            // Un apprenant ne peut évaluer qu'une seule fois une formation
            $table->unique(['formation_id', 'user_id']);
            
            // Index pour optimiser les recherches
            $table->index('note');
            $table->index('formateur_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};