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
        Schema::table('json_funcionalidades_keys', function (Blueprint $table) {
            //
             $table->string('level1')->nullable();
             $table->string('level2')->nullable();
             $table->string('level3')->nullable();
             $table->string('level4')->nullable();
             $table->string('level5')->nullable();
             $table->string('level6')->nullable();
             $table->string('level7')->nullable();
             $table->string('level8')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('json_funcionalidades_keys', function (Blueprint $table) {
            //
             $table->dropColumn(['level1', 'level2', 'level3','level4', 'level5', 'level6','level7', 'level8']);
        });
    }
};
