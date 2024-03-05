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
        Schema::create('slips', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->foreignId("user_id");
            $table->string("bettable_type");
            $table->foreignId("bettable_id");
            $table->decimal("amount");
            $table->decimal("profit", 12, 2)->nullable();
            $table->decimal("payout", 12, 2)->nullable();
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
        Schema::dropIfExists('slips');
    }
};
