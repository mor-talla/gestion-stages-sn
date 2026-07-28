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
    Schema::create('entreprises', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('slug')->unique();
        $table->text('adresse');
        $table->foreignId('ville_id')->constrained()->onDelete('cascade');
        $table->string('telephone');
        $table->string('email');
        $table->string('site_web')->nullable();
        $table->string('logo')->nullable();
        $table->text('description')->nullable();
        $table->string('secteur_activite');
        $table->string('taille')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
