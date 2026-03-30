<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['assigned_user_id']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_user_id')->nullable()->change();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('assigned_user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['assigned_user_id']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_user_id')->nullable(false)->change();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('assigned_user_id')->references('id')->on('users');
        });
    }
};
