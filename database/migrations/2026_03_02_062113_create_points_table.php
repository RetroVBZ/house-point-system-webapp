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
        Schema::create('Points', function (Blueprint $table) {
            $table->unsignedInteger('houseID');
            $table->unsignedInteger('teacherID');
            $table->integer('Points');
            $table->date('Time');
            $table->timestamps();
            $table->primary(['houseID', 'teacherID']);
            $table->foreign('houseID')->references('houseID')->on('Houses');
            $table->foreign('teacherID')->references('teacherID')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Points');
    }
};
