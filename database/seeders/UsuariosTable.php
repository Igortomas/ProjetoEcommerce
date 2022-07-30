<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'usuario' => 'admin',
            'senha' => '123',
            'email' => 'admin@teste.com',
            'nome_completo' => 'admin teste',
            'cpf' => '12345678901',
            'cep' => '12345678',
            'endereco' => 'teste',
            'numero' => '123',
            'telefone' => '12345678',
            'nivel' => '1'
        ]);

        DB::table('usuarios')->insert([
            'usuario' => 'cliente',
            'senha' => '123',
            'email' => 'cliente@teste.com',
            'nome_completo' => 'cliente teste',
            'cpf' => '12345678901',
            'cep' => '12345678',
            'endereco' => 'teste',
            'numero' => '123',
            'telefone' => '12345678',
            'nivel' => '0'
        ]);
    }
}
