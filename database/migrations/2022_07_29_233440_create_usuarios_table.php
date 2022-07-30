<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuario', 200);
            $table->string('senha', 200);
            $table->string('email', 200);
            $table->string('nome_completo', 200);
            $table->string('cpf', 11);
            $table->string('cep', 8);
            $table->string('endereco', 200);
            $table->string('numero', 20);
            $table->string('telefone', 11);
            $table->string('nivel', 1)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
