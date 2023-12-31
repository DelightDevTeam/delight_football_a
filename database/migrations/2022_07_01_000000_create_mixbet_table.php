<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\SoftDeletes;

class CreateMixbetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mixbet', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_id');
            $table->integer('odd_id');
            $table->string('league_name');
            $table->string('home');
            $table->string('away');
            $table->string('bet');
            $table->string('rate');
            $table->double('amount');
            $table->integer('result_h')->nullable();
            $table->integer('result_a')->nullable();
            $table->integer('p_id');
            $table->unsignedBigInteger('playerId');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->smallinteger('status');
            $table->foreign('playerId')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mixbet');
    }
}