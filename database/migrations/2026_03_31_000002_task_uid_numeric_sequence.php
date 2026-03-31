<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('task_uid_sequence', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary();
            $table->unsignedInteger('next_number');
        });

        DB::table('task_uid_sequence')->insert([
            'id' => 1,
            'next_number' => 1000,
        ]);

        $maxM = 0;
        foreach (DB::table('tasks')->whereNotNull('task_uid')->pluck('task_uid') as $u) {
            if (preg_match('/^T(\d+)$/', (string) $u, $m)) {
                $maxM = max($maxM, (int) $m[1]);
            }
        }
        $next = $maxM >= 1000 ? $maxM + 1 : 1000;
        DB::table('task_uid_sequence')->where('id', 1)->update(['next_number' => $next]);

        Schema::table('tasks', function (Blueprint $table) {
            $table->string('task_uid', 32)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->uuid('task_uid')->nullable()->change();
        });

        Schema::dropIfExists('task_uid_sequence');
    }
};
