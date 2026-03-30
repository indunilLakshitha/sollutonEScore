<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('commission_enabled')->default(true);
            $table->boolean('reg_success_mail_enabled')->default(true);
            $table->boolean('reg_success_sms_enabled')->default(true);
            $table->boolean('approved_mail_enabled')->default(true);
            $table->boolean('approved_sms_enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_settings');
    }
};

