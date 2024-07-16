<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('categoria_id')->constrained('categorias')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreignId('bilhete_id')->constrained('bilhetes')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreignId('sorteio_id')->constrained('sorteios')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->string('nome');
            $table->double('preco')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('modelo')->default(0)->comment("0-cliente escolhe 1-sistema escolhe");
            $table->longText('descricao')->nullable()->comment('Regulamento');
            $table->integer('minima')->default(1)->comment('Quantidade minima de bilhetes por compra');
            $table->integer('maxima')->default(300)->comment('Quantidade maxima de bilhetes por compra');
            $table->integer('filtro')->nullable()->comment('0-Mostrar todos 1-somente bilhetes disponíveis');
            $table->dateTime('data')->nullable()->comment('se existir data');
            $table->string('tempo')->nullable()->comment('Tempo para pagamento');
            $table->string('email')->nullable();
            $table->integer('top')->default(1)->comment('0-nao 1-Mostrar top 3 ranking');
            $table->integer('inicial')->default(0);
            $table->integer('situacao')->default(0);
            $table->timestamps();
            $table->softDeletes();
            });
    }

    public function down(): void
    {
        Schema::drop('campanhas');
    }
};
