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
        Schema::create('vuelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("avion_id")->constrained('avions')->cascadeOnDelete();
            $table->string("image");
            $table->string("origen");
            $table->string("destino");
            $table->date("fecha");
            $table->string("hora");
            $table->string("precio");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vuelos');
    }
};
