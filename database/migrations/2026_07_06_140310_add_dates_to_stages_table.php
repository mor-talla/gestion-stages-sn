<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->date('date_debut')->nullable()->after('duree');
            $table->date('date_fin')->nullable()->after('date_debut');
            $table->date('date_limite_candidature')->nullable()->after('date_fin');
        });
    }

    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropColumn(['date_debut', 'date_fin', 'date_limite_candidature']);
        });
    }
};