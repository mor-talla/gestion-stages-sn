<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
public function up()
{
    Schema::create('stages', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('slug')->unique();
        $table->text('description');
        $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
        $table->foreignId('ville_id')->constrained()->onDelete('cascade');
        $table->string('adresse_exacte')->nullable();
        $table->string('duree');
        $table->boolean('remuneration')->default(false);
        $table->decimal('montant_remuneration', 10, 2)->nullable();
        $table->date('date_debut');
        $table->date('date_fin');
        $table->enum('type', ['technique', 'professionnel', 'recherche', 'autre']);
        $table->enum('statut', ['ouvert', 'ferme', 'en_cours'])->default('ouvert');
        $table->text('competences_requises')->nullable();
        $table->integer('nb_postes')->default(1);
        $table->date('date_limite_candidature');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
