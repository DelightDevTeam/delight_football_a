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
            $table->foreignId("user_id");
            $table->foreignId("league_id");
            $table->foreignId("fixture_id");
            $table->foreignId("market_id");
            $table->foreignId("home_team_id");
            $table->foreignId("away_team_id");
            $table->foreignId("upper_team_id");
            $table->foreignId("lower_team_id");
            $table->foreignId("handicap_team_id");
            $table->decimal("amount");
            $table->decimal("possible_payout", 12, 2)->nullable();
            $table->decimal("profit", 12, 2)->nullable();
            $table->decimal("payout", 12, 2)->nullable();
            $table->json("commission_setting_obj")->nullable();
            $table->string("status")->default(BetStatus::Pending->value);
            $table->integer("win_percent")->nullable();
            $table->string("type");
            $table->json("ab_obj")->nullable();
            $table->string("ab_selected_side")->nullable();
            $table->json("ou_obj")->nullable();
            $table->string("ou_selected_side")->nullable();
            $table->dateTime("calculated_at")->nullable();
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
