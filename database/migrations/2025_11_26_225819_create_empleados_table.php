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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            // Relación con clientes (empresa)
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade');

            // Datos del empleado
            $table->string('tipo_documento')->default('DNI');
            $table->string('numero_documento');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');

            $table->date('fecha_ingreso');

            $table->string('cargo')->nullable();

            $table->decimal('sueldo', 8, 2)->default(0.00);

            $table->enum('pension', ['ONP', 'AFP'])->default('ONP');

            $table->boolean('asignacion_familiar')->default(false);

            $table->enum('tipo', [
                'trabajador',
                'pensionado',
                'independiente'
            ])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
