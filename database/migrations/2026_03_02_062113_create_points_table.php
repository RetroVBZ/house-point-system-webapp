<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Points', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->unsignedInteger('houseID');
            $table->unsignedInteger('teacherID');
            $table->integer('Points'); // positive or negative
            $table->date('Time');
            $table->timestamps();

            // Foreign keys
            $table->foreign('houseID')->references('houseID')->on('Houses')->onDelete('cascade');
            $table->foreign('teacherID')->references('teacherID')->on('teachers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Points');
    }
};
