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
        Schema::create('class_schedules', function (Blueprint $table) {
    $table->id();
    $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
    $table->foreignId('instructor_id')->constrained('instructors')->cascadeOnDelete();
    $table->dateTime('start_time');
    $table->dateTime('end_time');
    $table->string('room_location', 50)->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
