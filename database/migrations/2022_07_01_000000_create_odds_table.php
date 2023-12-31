<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\SoftDeletes;

class CreateOddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odds', function (Blueprint $table) {
            $table->id();
            $table->string('sport_id');

            $table->string('sport_name');
            $table->timestamp('last_call');
            $table->integer('event_id');
            $table->integer('league_id');
            $table->string('league_name');
            $table->timestamp('starts')->nullable();
            $table->string('home');
            $table->string('away');
            $table->string('event_type');
            $table->smallinteger('is_have_odds');
            $table->double('money_line_h');
            $table->double('money_line_a');
            $table->double('money_line_d');
            $table->double('spreads_p');
            $table->double('spreads_h');
            $table->double('spreads_a');
            $table->double('totals_point');
            $table->double('over');
            $table->double('under');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->smallinteger('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odds');
    }
}