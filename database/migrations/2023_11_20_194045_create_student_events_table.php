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
        Schema::create('student_events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name', 100)->notNull();
            $table->string('event_desc', 255)->nullable();
            $table->date('event_date')->nullable();
            $table->time('event_time_in')->nullable();
            $table->time('event_time_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_events');
    }
};
