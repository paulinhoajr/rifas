<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('campanha_id');
            $table->string('nome');
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('premios');
    }
};
