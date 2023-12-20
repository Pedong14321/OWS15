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
        Schema::create('scholargrants', function (Blueprint $table) {
            $table->id();
            $table->string('Lname');
            $table->string('Fname');
            $table->string('Mname');
            $table->string('program');
            $table->string('type');
            $table->string('Yrlevel');
            $table->string('StudentEmail');
            $table->string('StudentID');
            $table->string('status')->default('active'); // Set a default value
            $table->string('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholargrants');
    }
};
