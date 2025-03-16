<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'title' => 'Finalizar documentação',
                'description' => 'Escrever a documentação do projeto.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Revisar código',
                'description' => 'Refatorar funções e melhorar a performance.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Enviar relatório',
                'description' => 'Enviar relatório semanal para a equipe.',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
