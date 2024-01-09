<?php

use App\Enums\PaymentMethod;
use App\Enums\TransactionRequestStatus;
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
        Schema::create('deposit_requests', function (Blueprint $table) {
            $table->id();
            $table->string("account_name");
            $table->string("account_username");
            $table->integer("amount");
            $table->string("external_transaction_id");
            $table->string("payment_method")->default(PaymentMethod::WaveMoney->value);
            $table->string("status")->default(TransactionRequestStatus::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_requests');
    }
};
