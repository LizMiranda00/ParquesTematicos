<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']); // Eliminar las columnas de latitud y longitud
            $table->string('location_url')->nullable(); // Agregar la columna para el enlace
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Volver a agregar las columnas de latitud y longitud
            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 11, 8)->nullable();
            // No se elimina la columna location_url
        });
    }
}