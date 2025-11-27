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
        Schema::create('planilla_detalles', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('planilla_id');
    $table->unsignedBigInteger('empleado_id');

    $table->integer('dias')->default(30);
    $table->decimal('ingresos', 10, 2)->default(0);
    $table->decimal('descuentos', 10, 2)->default(0);
    $table->decimal('aporte_trabajador', 10, 2)->default(0);
    $table->decimal('neto_pagar', 10, 2)->default(0);
    $table->decimal('aporte_empleador', 10, 2)->default(0);

    $table->enum('tipo', ['trabajador', 'pensionado', 'independiente'])->nullable();

    $table->timestamps();

    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_detalles');
    }
};
