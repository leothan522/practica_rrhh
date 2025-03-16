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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('estados_id')->nullable();
            $table->unsignedBigInteger('municipios_id')->nullable();
            $table->unsignedBigInteger('parroquias_id')->nullable();
            $table->foreign('estados_id')->references('id')->on('estados')->nullOnDelete();
            $table->foreign('municipios_id')->references('id')->on('municipios')->nullOnDelete();
            $table->foreign('parroquias_id')->references('id')->on('parroquias')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
