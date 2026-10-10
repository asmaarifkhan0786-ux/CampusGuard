<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('response_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('team_type', [
                'medical', 'security', 'fire', 'rescue', 'other'
            ])->default('other');
            $table->string('leader_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->enum('availability', [
                'available', 'busy', 'unavailable'
            ])->default('available');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('response_teams');
    }
};