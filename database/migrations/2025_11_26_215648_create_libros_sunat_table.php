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
        Schema::create('libros_sunat', function (Blueprint $table) {
            $table->id();
            
            // Relación con Cliente
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            // Tipo de libro
            $table->enum('tipo_libro', [
                'compras',
                'ventas',
                'diario',
                'mayor',
                'inventarios',
                'balance',
                'otro'
            ]);

            // Periodo contable (202501)
            $table->string('periodo', 6);

            // Estado del libro
            $table->enum('estado', [
                'pendiente',
                'enviado',
                'observado'
            ])->default('pendiente');

            // Archivo TXT subido
            $table->string('archivo')->nullable();

            // Observaciones
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros_sunat');
    }
};
