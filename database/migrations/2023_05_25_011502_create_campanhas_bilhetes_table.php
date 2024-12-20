<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campanhas_bilhetes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('numero');
            $table->foreignId('campanha_id')->constrained('campanhas')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreignId('usuario_id')->nullable();
            $table->integer('situacao')->default(0)->comment('0-novo 1-reservado 2-escolhido');
            $table->dateTime('expira')->nullable();
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('campanhas_bilhetes');
    }
};
