<?php

use App\Enums\UserType;
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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('username')->nullable();
            $table->string('name');
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile', 2000)->nullable();
            $table->string('profile_mime')->nullable();
            $table->integer('profile_size')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->default(0);
            $table->decimal('max_for_mix_bet')->default('0');
            $table->decimal('max_for_single_bet')->default('0');
            $table->decimal('commission')->default('0');
            $table->decimal('high_commission')->default('0');
            $table->decimal('two_d_commission')->default('0');
            $table->decimal('three_d_commission')->default('0');
            $table->decimal('m_c_two_commission')->default('0');
            $table->decimal('m_c_three_commission')->default('0');
            $table->decimal('m_c_four_commission')->default('0');
            $table->decimal('m_c_five_commission')->default('0');
            $table->decimal('m_c_six_commission')->default('0');
            $table->decimal('m_c_seven_commission')->default('0');
            $table->decimal('m_c_eight_commission')->default('0');
            $table->decimal('m_c_nine_commission')->default('0');
            $table->decimal('m_c_ten_commission')->default('0');
            $table->decimal('m_c_eleven_commission')->default('0');
            $table->string("type")->default(UserType::User)->value;
            $table->rememberToken();
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
