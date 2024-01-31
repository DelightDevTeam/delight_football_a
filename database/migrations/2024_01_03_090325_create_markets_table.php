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
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("scrapper_id")->nullable();
            $table->foreignId("league_id");
            $table->foreignId("fixture_id");
            $table->foreignId("upper_team_id");
            $table->foreignId("lower_team_id");
            $table->foreignId("handicap_team_id");
            $table->json("ab")->nullable();
            $table->float("ab_odd")->nullable();
            $table->json("ou")->nullable();
            $table->float("ou_odd")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
