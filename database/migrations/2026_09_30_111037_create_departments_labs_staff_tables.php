<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Departments
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Laboratories / Venues
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->unsignedSmallInteger('capacity')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Staff (Permanent + Visiting)
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_code', 30)->nullable()->unique();
            $table->string('title')->nullable();               // Prof, Dr, Mr, Ms...
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->enum('staff_type', ['permanent', 'visiting', 'temporary'])->default('permanent');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Link Laravel users table to staff (optional)
        Schema::table('users', function (Blueprint $table) {
            // We will create a proper users table next if needed
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
        Schema::dropIfExists('laboratories');
        Schema::dropIfExists('departments');
    }
};