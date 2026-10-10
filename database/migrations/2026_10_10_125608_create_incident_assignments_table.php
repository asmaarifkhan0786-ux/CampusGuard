
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incident_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('emergency_report_id')
                ->constrained('emergency_reports')
                ->cascadeOnDelete();

            $table->foreignId('response_team_id')
                ->constrained('response_teams')
                ->cascadeOnDelete();

            $table->foreignId('assigned_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();

            $table->enum('status', [
                'assigned', 'accepted', 'in_progress', 'completed'
            ])->default('assigned');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_assignments');
    }
};
