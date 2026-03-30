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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->index()->startingValue(1000);
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('reg_no')->nullable()->unique()->index()->comment('using as id for system admins [regirtration id]');
            $table->string('unique_id')->nullable()->unique()->index()->comment('using as id for nackend');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nic')->index()->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->date('dob')->nullable();
            $table->string('type', 20)->nullable()->comment(' main | right side | left side');
            $table->tinyInteger('status')->default(3)->comment('1 = NONE | 3  = FULL | HALF = 2 | 4 = ER');
            $table->tinyInteger('active_status')->default(1)->comment('1 = ACTIVE | 2  = BLOCKED');
            $table->tinyInteger('is_admin')->default(0)->comment('0 = NONE | 1  = ADMIN');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('parent_unique_id')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
