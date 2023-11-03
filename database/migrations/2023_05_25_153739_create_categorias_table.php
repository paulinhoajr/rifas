<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('categorias');
    }
};
