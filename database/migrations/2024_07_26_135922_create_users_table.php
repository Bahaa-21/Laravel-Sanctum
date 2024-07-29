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
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('profile_photo')->nullable();
            $table->string('certificate')->nullable();
            $table->string('code')->nullable();
            $table->timestamp('code_expires_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('google2fa_secret')->nullable();
            $table->boolean('2fa_enabled')->default(false);
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
