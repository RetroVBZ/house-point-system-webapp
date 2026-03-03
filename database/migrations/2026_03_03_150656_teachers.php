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
        Schema::create('teachers', function (Blueprint $table) {
            $table->string('teacherID', 2)->primary();
            $table->text('teacherFirstName');
            $table->text('teacherLastName');
            $table->unsignedInteger('houseID');
            $table->timestamps();
            $table->foreign('houseID')->references('houseID')->on('Houses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
