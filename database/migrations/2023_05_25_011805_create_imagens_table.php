<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagens', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('campanha_id');
            $table->string('nome')->nullable();
            $table->string('caminho');
            $table->integer('ordem')->nullable();
            $table->integer('situacao')->nullable();
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('imagens');
    }
};
