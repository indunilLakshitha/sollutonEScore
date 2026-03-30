<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_monthly_bonuses', function (Blueprint $table) {
            $table->decimal('cash_amount', 12, 2)->nullable()->after('bonus_type');
            $table->string('gift_name', 255)->nullable()->after('cash_amount');
        });
    }

    public function down(): void
    {
        Schema::table('user_monthly_bonuses', function (Blueprint $table) {
            $table->dropColumn(['cash_amount', 'gift_name']);
        });
    }
};

