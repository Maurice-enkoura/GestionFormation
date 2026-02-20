 <?php
 use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            // Ajout de la progression de l'apprenant (0 → 100%)
            $table->unsignedTinyInteger('progression')
                  ->default(0)
                  ->after('statut');
        });
    }

    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            $table->dropColumn('progression');
        });
    }
};