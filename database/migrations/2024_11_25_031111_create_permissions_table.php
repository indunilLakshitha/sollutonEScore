<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('level_one_available')->default(true)->comment('available when not activated');
            $table->boolean('level_two_available')->default(false)->comment('available when Half activated');
            $table->boolean('level_three_available')->default(false)->comment('available when Full activated');
            $table->boolean('level_er_available')->default(false)->comment('available when ER activated');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
