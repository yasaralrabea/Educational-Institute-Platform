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
        Schema::create('students_tasks', function (Blueprint $table) {
            $table->id();
             $table->string('subject');
            $table->string('url')->nullable();
            $table->string('file_path')->nullable();
            $table->string('condition')->default('open');

             $table->date('open_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_tasks');
    }
};
