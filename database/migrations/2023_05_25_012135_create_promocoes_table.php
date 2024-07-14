<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promocoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('campanha_id')->constrained('campanhas')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->integer('quantidade')->nullable();
            $table->double('valor')->nullable();
            $table->integer('situcao')->nullable();
            $table->timestamps();
            $table->softDeletes();
            });
    }

    public function down(): void
    {
        Schema::drop('promocoes');
    }
};
