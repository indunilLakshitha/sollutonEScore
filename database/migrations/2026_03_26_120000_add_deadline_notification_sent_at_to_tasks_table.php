<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->timestamp('pre_deadline_reminder_sent_at')->nullable()->after('rejected_at');
            $table->timestamp('deadline_imminent_alert_sent_at')->nullable()->after('pre_deadline_reminder_sent_at');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['pre_deadline_reminder_sent_at', 'deadline_imminent_alert_sent_at']);
        });
    }
};
