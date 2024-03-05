<?php

use App\Enums\BetStatus;
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
        Schema::create('parlays', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->decimal("amount");
            $table->decimal("possible_payout", 12, 2)->nullable();
            $table->decimal("profit", 12, 2)->nullable();
            $table->decimal("payout", 12, 2)->nullable();
            $table->json("commission_setting_obj")->nullable();
            $table->string("status")->default(BetStatus::Pending->value);
            $table->dateTime("calculated_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parlays');
    }
};

