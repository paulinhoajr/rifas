<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promocoes', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('campanha_id');
            $table->integer('quantidade')->nullable();
            $table->double('valor')->nullable();
            $table->integer('situcao')->nullable();
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('promocoes');
    }
};
