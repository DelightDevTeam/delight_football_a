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
        Schema::create('singles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("league_id");
            $table->unsignedInteger("fixture_id");
            $table->unsignedInteger("market_id");
            $table->decimal("amount");
            $table->decimal("possible_payout")->nullable();
            $table->decimal("payout")->nullable();
            $table->json("commission_setting_obj")->nullable();
            $table->string("status")->default(BetStatus::Pending->value);
            $table->integer("win_percent")->nullable();
            $table->string("type");
            $table->json("ab_obj")->nullable();
            $table->string("ab_selected_side")->nullable();
            $table->json("ou_obj")->nullable();
            $table->string("ou_selected_side")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('singles');
    }
};
