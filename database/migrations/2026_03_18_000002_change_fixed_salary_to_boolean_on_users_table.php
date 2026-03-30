<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'fixed_salary')) {
            return;
        }

        // Convert to boolean-ish TINYINT(1) for true/false semantics.
        // MySQL treats BOOLEAN as TINYINT(1).
        DB::statement("ALTER TABLE `users` MODIFY `fixed_salary` TINYINT(1) NULL DEFAULT 0");
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'fixed_salary')) {
            return;
        }

        DB::statement("ALTER TABLE `users` MODIFY `fixed_salary` DECIMAL(10,2) NULL");
    }
};

