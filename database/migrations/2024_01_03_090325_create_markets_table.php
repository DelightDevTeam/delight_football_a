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
            $table->unsignedInteger("fixture_id");
            $table->unsignedInteger("upper_team_id");
            $table->unsignedInteger("lower_team_id");
            $table->unsignedInteger("handicap_team_id");
            $table->json("hdp")->nullable();
            $table->float("hdp_home")->nullable();
            $table->float("hdp_away")->nullable();
            $table->json("ou")->nullable();
            $table->float("ou_over")->nullable();
            $table->float("ou_under")->nullable();
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
