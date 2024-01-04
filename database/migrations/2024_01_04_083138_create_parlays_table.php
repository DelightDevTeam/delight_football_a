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
            $table->unsignedInteger("user_id");
            $table->decimal("amount");
            $table->decimal("possible_payout")->nullable();
            $table->decimal("payout")->nullable();
            $table->json("commission_setting_obj")->nullable();
            $table->string("status")->default(BetStatus::Pending->value);
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

