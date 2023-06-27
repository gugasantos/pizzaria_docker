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
            $table->string('pizzas');
            $table->foreignId('client_id')->constrained('client','id');
            $table->string('note')->nullable();
            $table->binary('edge');
            $table->integer('price');
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
