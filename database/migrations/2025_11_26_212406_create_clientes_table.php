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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ruc', 11)->unique();
            $table->string('dni', 8)->nullable();
            $table->string('clave_sol')->nullable();
            $table->string('password_sol')->nullable();
            $table->string('grupo')->nullable(); // Ej: alimentos, transporte, salud
            $table->enum('estado', ['urgente','proxima_fecha','concluido','inactivo'])->default('proxima_fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
