<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id('qrcode_id');
            $table->string('qrcode_filename', 100);
            $table->string('student_osasid');
            $table->timestamps();
        });

        // Offices initial data
        DB::table('qr_codes')->insert([
            'qrcode_id' => 1,
            'qrcode_filename' => 'sample',
            'student_osasid' => '2',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
