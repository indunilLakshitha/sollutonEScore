<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('user_monthly_salaries') || Schema::hasColumn('user_monthly_salaries', 'sales_count')) {
            return;
        }

        Schema::table('user_monthly_salaries', function (Blueprint $table) {
            $table->unsignedInteger('sales_count')->default(0)->after('amount');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('user_monthly_salaries') || !Schema::hasColumn('user_monthly_salaries', 'sales_count')) {
            return;
        }

        Schema::table('user_monthly_salaries', function (Blueprint $table) {
            $table->dropColumn('sales_count');
        });
    }
};
