<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Phases (Phase I, II, III)
        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();          // e.g. P1, P2, P3
            $table->string('name');                        // Phase I, Phase II...
            $table->unsignedTinyInteger('order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Strands
        Schema::create('strands', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Batches
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();          // e.g. AA, AW, SS
            $table->string('academic_year');               // 2023/2024
            $table->unsignedTinyInteger('current_year')->default(1); // 1–5
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Modules
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();          // e.g. ALNU1, CARE2
            $table->string('name');
            $table->foreignId('phase_id')->nullable()->constrained('phases')->nullOnDelete();
            $table->foreignId('strand_id')->nullable()->constrained('strands')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Holidays
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('holiday_date');
            $table->enum('type', ['public', 'faculty'])->default('public');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('batches');
        Schema::dropIfExists('strands');
        Schema::dropIfExists('phases');
    }
};