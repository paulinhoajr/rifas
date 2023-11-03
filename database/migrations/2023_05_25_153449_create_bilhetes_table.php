<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bilhetes', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('nome')->nullable();
            $table->integer('quantidade');
            $table->integer('situacao')->default(1);
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('bilhetes');
    }
};
