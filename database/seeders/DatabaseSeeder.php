<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário admin
        DB::table('users')->insert([
            'nome' => 'Administrador',
            'email' => 'admin@apostas.com',
            'cpf' => '00000000000',
            'telefone' => '11999999999',
            'data_nascimento' => '1990-01-01',
            'password' => Hash::make('password'),
            'saldo' => 0.00,
            'is_admin' => true,
            'ativo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Criar pilotos de exemplo
        $pilotos = [
            ['nome' => 'João Silva', 'numero' => 15, 'categoria' => 'MX1'],
            ['nome' => 'Pedro Santos', 'numero' => 7, 'categoria' => 'MX1'],
            ['nome' => 'Carlos Oliveira', 'numero' => 22, 'categoria' => 'MX1'],
            ['nome' => 'Rafael Lima', 'numero' => 33, 'categoria' => 'MX2'],
            ['nome' => 'Lucas Costa', 'numero' => 8, 'categoria' => 'MX2'],
            ['nome' => 'Marcos Souza', 'numero' => 11, 'categoria' => 'MX2'],
            ['nome' => 'Fernando Alves', 'numero' => 99, 'categoria' => 'MX3'],
            ['nome' => 'Gustavo Pereira', 'numero' => 44, 'categoria' => 'MX3'],
        ];

        foreach ($pilotos as $piloto) {
            DB::table('pilotos')->insert([
                'nome' => $piloto['nome'],
                'numero' => $piloto['numero'],
                'categoria' => $piloto['categoria'],
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Criar corrida de exemplo
        $corridaId = DB::table('corridas')->insertGetId([
            'nome' => 'Campeonato Brasileiro de Motocross 2025',
            'local' => 'São Paulo - SP',
            'data_hora' => '2025-12-15 14:00:00',
            'categoria' => 'MX1',
            'descricao' => 'Primeira etapa do campeonato brasileiro',
            'status' => 'aberta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Vincular pilotos à corrida
        DB::table('corrida_piloto')->insert([
            ['corrida_id' => $corridaId, 'piloto_id' => 1, 'cotacao' => 3.50, 'created_at' => now(), 'updated_at' => now()],
            ['corrida_id' => $corridaId, 'piloto_id' => 2, 'cotacao' => 2.80, 'created_at' => now(), 'updated_at' => now()],
            ['corrida_id' => $corridaId, 'piloto_id' => 3, 'cotacao' => 5.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

