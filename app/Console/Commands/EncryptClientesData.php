<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cliente;

class EncryptClientesData extends Command
{
    protected $signature = 'clientes:encrypt';
    protected $description = 'Encripta clave_sol y password_sol que estén en texto plano';

    public function handle()
    {
        $clientes = Cliente::all();
        $count = 0;

        foreach ($clientes as $cliente) {

            // Si ya está encriptado, saltar
            if ($cliente->clave_sol && str_starts_with($cliente->clave_sol, 'eyJ')) {
                continue;
            }

            if ($cliente->password_sol && str_starts_with($cliente->password_sol, 'eyJ')) {
                continue;
            }

            // Asignar para activar el mutator y encriptar
            if ($cliente->clave_sol) {
                $cliente->clave_sol = $cliente->clave_sol;
            }

            if ($cliente->password_sol) {
                $cliente->password_sol = $cliente->password_sol;
            }

            $cliente->save();
            $count++;
        }

        $this->info("✔ Se encriptaron $count registros correctamente.");
    }
}
