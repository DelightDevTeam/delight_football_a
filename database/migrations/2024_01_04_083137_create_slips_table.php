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
            $table->unsignedInteger("user_id");
            $table->string("bettable_type");
            $table->unsignedInteger("bettable_id");
            $table->decimal("amount");
            $table->decimal("payout")->nullable();
            $table->string("status")->default(BetStatus::Pending->value);
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
