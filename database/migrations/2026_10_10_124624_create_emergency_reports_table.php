<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('crisis_category_id')
                ->nullable()
                ->index();

            $table->string('title');
            $table->text('description');
            $table->string('location');

            $table->enum('priority', [
                'low', 'medium', 'high', 'critical'
            ])->default('medium');

            $table->enum('status', [
                'pending',
                'under_review',
                'assigned',
                'in_progress',
                'resolved',
                'rejected'
            ])->default('pending');

            $table->string('contact_number')->nullable();
            $table->string('evidence_path')->nullable();
            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_reports');
    }
};