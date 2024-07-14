<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('campanha_id')->constrained('campanhas')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->string('nome');
            $table->longText('descricao');
            $table->timestamps();
            $table->softDeletes();
            });
    }

    public function down(): void
    {
        Schema::drop('premios');
    }
};
