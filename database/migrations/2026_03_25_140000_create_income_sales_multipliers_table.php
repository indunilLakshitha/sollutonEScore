<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('income_sales_multipliers', function (Blueprint $table) {
            $table->id();
            $table->decimal('management_multiplier', 12, 2)->default(1000);
            $table->decimal('director_multiplier', 12, 2)->default(4000);
            $table->timestamps();
        });

        // Ensure there's always one row for the admin-configurable multipliers.
        DB::table('income_sales_multipliers')->insert([
            'management_multiplier' => 1000,
            'director_multiplier' => 4000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('income_sales_multipliers');
    }
};

