<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa');
            $table->integer('id_UsuarioCreo');
            $table->date('fecha_creacion');
            $table->string('Noticia');
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
        Schema::drop('Noticias');
    }
}
