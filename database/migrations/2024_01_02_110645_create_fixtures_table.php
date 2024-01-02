<?php

use App\Enums\FixtureStatus;
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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('scraper_id')->nullable();
            $table->unsignedInteger('league_id');
            $table->unsignedInteger('home_team_id');
            $table->unsignedInteger('away_team_id');
            $table->string('raw_date_time')->nullable();
            $table->dateTime('date_time');
            $table->tinyInteger("ft_home_goal")->default(0);
            $table->tinyInteger("ft_away_goal")->default(0);
            $table->string("ft_status")->default(FixtureStatus::NS->value);
            $table->boolean("confirmed")->default(false);
            $table->boolean("active")->default(true);
            $table->boolean("manually_updated")->default(false);
            $table->boolean("stop_update")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
