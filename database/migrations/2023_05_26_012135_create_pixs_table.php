<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pixs', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('campanha_id');
            $table->foreignId('usuario_id');
            $table->json('lista');
            $table->integer('linhas');
            $table->text('chave');
            $table->text('qrcode');
            $table->string('txid');
            $table->string('expire');
            $table->integer('situacao')->comment("0-novo 1-pago 2-cancelado");
            $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::drop('pixs');
    }
};
