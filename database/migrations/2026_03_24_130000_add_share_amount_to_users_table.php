<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('users', 'share_amount')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->decimal('share_amount', 12, 2)->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'share_amount')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('share_amount');
        });
    }
};
