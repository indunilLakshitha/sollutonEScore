<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_setting_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('status');
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_setting_histories');
    }
};

