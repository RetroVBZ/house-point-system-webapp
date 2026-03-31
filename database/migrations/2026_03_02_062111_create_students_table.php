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
        Schema::create('students', function (Blueprint $table) {
            $table->string('studentID', 7)->primary();
            $table->unsignedInteger('houseID');
            $table->text('studentFirstName');
            $table->text('studentLastName');
            $table->string('Grade');
            $table->char('section', 1);
            $table->timestamps();
            $table->foreign('houseID')->references('houseID')->on('Houses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
