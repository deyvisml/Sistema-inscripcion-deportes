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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable(false)->unique();
            $table->string('password')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('ap_paterno')->nullable(false);
            $table->string('ap_materno')->nullable(false);
            $table->foreignId("escuela_id")->constrained()->onDelete("cascade");
            $table->foreignId("tipo_id")->constrained()->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
