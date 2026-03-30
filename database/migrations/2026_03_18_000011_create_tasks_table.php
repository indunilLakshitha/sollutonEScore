<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_category_id')->constrained('task_categories');
            $table->foreignId('assigned_user_id')->constrained('users');

            $table->string('name');
            $table->unsignedInteger('max_score')->default(0);
            $table->dateTime('deadline_at')->nullable();

            // Status flow: Assigned -> Submitted -> Approved/Rejected -> (Expired computed)
            $table->string('status', 20)->default('Assigned');

            // Submission
            $table->text('submission_note')->nullable();
            $table->dateTime('submitted_at')->nullable();

            // Approval / scoring
            $table->unsignedInteger('score')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('rejected_at')->nullable();

            $table->timestamps();

            $table->index(['assigned_user_id', 'status']);
            $table->index(['task_category_id']);
            $table->index(['deadline_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

