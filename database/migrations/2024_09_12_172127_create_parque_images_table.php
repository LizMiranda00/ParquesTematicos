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
        Schema::create('parque_images', function (Blueprint $table) {
            $table->id();  // ID autoincremental
            $table->unsignedBigInteger('user_id');  // ID del parque asociado
            $table->string('image_path');  // Ruta de la imagen
            $table->timestamps();  // Campos para created_at y updated_at
    
            // Llave foránea que referencia a la tabla 'parques'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parque_images');
    }
};
