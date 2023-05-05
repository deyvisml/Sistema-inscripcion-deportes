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
        Schema::create('inscritos', function (Blueprint $table) {
            $table->id();
            $table->string("codigo")->nullable(false);
            $table->string("name")->nullable(false);
            $table->string("ap_paterno")->nullable(false);
            $table->string("ap_materno")->nullable(false);
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("escuela_id")->constrained()->onDelete("cascade");
            $table->foreignId("deporte_id")->constrained()->onDelete("cascade");
            $table->foreignId("estado_id")->constrained()->onDelete("cascade");
            $table->timestamp("deleted_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscritos');
    }
};
