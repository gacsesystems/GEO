<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParametroSistema;

class ParametrosSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParametroSistema::updateOrCreate(
            ['clave' => 'LimiteGeneralEncuestasCliente'],
            ['valor' => '15', 'descripcion' => 'Límite general de encuestas por cliente']
        );
        ParametroSistema::updateOrCreate(
            ['clave' => 'MesesDepuracionRespuestas'],
            ['valor' => '6', 'descripcion' => 'Meses a conservar respuestas antes de depurar (0 = no depurar)']
        );
    }
}
