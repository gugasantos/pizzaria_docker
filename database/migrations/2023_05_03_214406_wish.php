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
            $table->integer('pizzas');
            $table->integer('client');
            $table->string('note');
            $table->binary('edge');
            $table->integer('price');
            $table->dateTime('created_at');

            $table->foreign('pizzas')->references('id')->on('menu');
            $table->foreign('client')->references('id')->on('client');
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
