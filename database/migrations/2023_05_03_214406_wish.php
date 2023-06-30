<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wish', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pizzas_id')->constrained('pizzas_pedido','id');
            $table->foreignId('client_id')->constrained('client','id');
            $table->string('note')->nullable();
            $table->boolean('edge');
            $table->integer('price');
            $table->boolean('finalizado');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
