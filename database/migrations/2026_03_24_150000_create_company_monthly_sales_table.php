<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_monthly_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month'); // 1..12
            $table->unsignedInteger('sales_count')->default(0);
            $table->timestamps();

            $table->unique(['year', 'month']);
            $table->index(['month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_monthly_sales');
    }
};
