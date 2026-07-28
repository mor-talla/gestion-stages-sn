<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne role (si elle n'existe pas)
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'etudiant', 'entreprise'])->default('etudiant');
            }
            
            // Ajouter telephone (si elle n'existe pas)
            if (!Schema::hasColumn('users', 'telephone')) {
                $table->string('telephone')->nullable();
            }
            
            // Ajouter adresse (si elle n'existe pas)
            if (!Schema::hasColumn('users', 'adresse')) {
                $table->text('adresse')->nullable();
            }
            
            // Ajouter entreprise_id (si elle n'existe pas)
            if (!Schema::hasColumn('users', 'entreprise_id')) {
                $table->foreignId('entreprise_id')->nullable()->constrained()->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'telephone', 'adresse', 'entreprise_id']);
        });
    }
};