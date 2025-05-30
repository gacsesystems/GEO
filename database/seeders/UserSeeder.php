<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener los Roles de la base de datos (asumiendo que RoleSeeder ya se ejecutó)
        $rolAdministrador = Role::where('nombre_rol', 'Administrador')->first();
        $rolCliente = Role::where('nombre_rol', 'Cliente')->first();
        // $rolEncuestado = Role::where('nombre_rol', 'Encuestado')->first(); // Si necesitas crear encuestados específicos

        // 2. Crear Usuario Administrador
        if ($rolAdministrador) {
            User::updateOrCreate(
                ['email' => 'sagt@gacse.com'], // Criterio para buscar/actualizar
                [
                    'nombre_completo' => 'Administrador Principal',
                    'password' => Hash::make('Gacse123'), // ¡CAMBIAR ESTO EN PRODUCCIÓN!
                    'id_rol' => $rolAdministrador->id_rol,
                    'id_cliente' => null, // El administrador no pertenece a un cliente específico
                    'activo' => true,
                    'email_verified_at' => now()->setTimezone('America/Mexico_City') // Marcar como verificado con hora de Ciudad de México
                ]
            );
        } else {
            $this->command->warn('Rol "Administrador" no encontrado. Saltando creación de usuario administrador.');
        }
        $adminUser = User::where('email', 'sagt@gacse.com')->first();

        // 3. Crear un Cliente de Ejemplo (opcional, pero útil para el usuario cliente)
        $clienteEjemplo = Cliente::updateOrCreate(
            ['alias' => 'HOSPITAL_DEMO'], // Criterio para buscar/actualizar
            [
                'razon_social' => 'Hospital de Demostración XYZ',
                'activo' => true,
                'limite_encuestas' => 10,
                'vigencia' => null,
                'ruta_logo' => null,
                'usuario_registro_id' => $adminUser?->id,
            ]
        );

        // 4. Crear Usuario Cliente de Ejemplo
        if ($rolCliente && $clienteEjemplo) {
            User::updateOrCreate(
                ['email' => 'cliente@example.com'], // Criterio
                [
                    'nombre_completo' => 'Usuario Cliente Demo',
                    'password' => Hash::make('password'), // ¡CAMBIAR ESTO!
                    'id_rol' => $rolCliente->id_rol,
                    'id_cliente' => $clienteEjemplo->id_cliente,
                    'activo' => true,
                    'email_verified_at' => now()->setTimezone('America/Mexico_City')
                ]
            );
        } else {
            if (!$rolCliente) {
                $this->command->warn('Rol "Cliente" no encontrado. Saltando creación de usuario cliente.');
            }
            if (!$clienteEjemplo && $rolCliente) { // Solo advertir si el rol existe pero el cliente no
                $this->command->warn('Cliente de ejemplo "HOSPITAL_DEMO" no encontrado/creado. Saltando creación de usuario cliente.');
            }
        }

        // Puedes añadir más usuarios o usar factories para datos masivos si lo necesitas después
        // Ejemplo de factory (requiere que tengas UserFactory.php configurado):
        // if ($rolEncuestado) {
        //     User::factory(10)->create(['id_rol' => $rolEncuestado->id_rol]);
        // }
    }
}
