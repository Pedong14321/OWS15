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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->unsignedBigInteger('student_osasid');
            $table->unsignedBigInteger('event_id');
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->timestamps();
    
            $table->foreign('student_osasid')->references('student_osasid')->on('students');
            $table->foreign('event_id')->references('event_id')->on('student_events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
