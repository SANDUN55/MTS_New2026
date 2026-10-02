<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Activity Types (Lecture, SDL, PBL, Practical, etc.)
        Schema::create('activity_types', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->boolean('requires_lecturer')->default(true);
            $table->boolean('is_group_activity')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Batch ↔ Module assignment (with chairs & duration)
        Schema::create('batch_module', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batches')->cascadeOnDelete();
            $table->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('chair_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->foreignId('co_chair_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->enum('status', ['draft', 'tentative', 'published', 'confirmed', 'completed'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();

            $table->unique(['batch_id', 'module_id']);
        });

        // Classes (the actual timetable entries)
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_module_id')->constrained('batch_module')->cascadeOnDelete();
            $table->foreignId('activity_type_id')->constrained('activity_types')->restrictOnDelete();
            $table->string('topic')->nullable();
            $table->string('group_name')->nullable();          // for group classes
            $table->date('class_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('laboratory_id')->nullable()->constrained('laboratories')->nullOnDelete();
            $table->string('venue')->nullable();               // free text venue if not a lab
            $table->enum('status', ['draft', 'scheduled', 'published', 'confirmed', 'conducted', 'cancelled', 'postponed'])->default('draft');
            $table->text('remarks')->nullable();
          $table->unsignedBigInteger('created_by')->nullable();
$table->unsignedBigInteger('updated_by')->nullable();
 $table->timestamps();
            $table->softDeletes();
        });

        // Class ↔ Staff (many lecturers can be assigned to one class)
        Schema::create('class_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->boolean('is_primary')->default(true);
            $table->timestamps();

            $table->unique(['class_id', 'staff_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_staff');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('batch_module');
        Schema::dropIfExists('activity_types');
    }
};