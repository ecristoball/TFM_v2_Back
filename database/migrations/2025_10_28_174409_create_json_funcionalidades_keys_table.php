<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('json_funcionalidades_keys', function (Blueprint $table) {
            $table->id();
             $table->string('key_name');      // Ejemplo: document, selfie, video...
            $table->string('parent_key')->nullable(); // Para claves anidadas 
            $table->string('level')->nullable();      // Nivel jerárquico 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('json_funcionalidades_keys');
    }
};
