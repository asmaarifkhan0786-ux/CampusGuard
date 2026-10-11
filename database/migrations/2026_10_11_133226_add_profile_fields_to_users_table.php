<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'department')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('department')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'designation')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('designation')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Profile fields are retained to avoid accidental data loss.
    }
};