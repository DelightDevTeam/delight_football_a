<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            <<<SQL
            ALTER TABLE transactions
            ADD COLUMN name VARCHAR(255) GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.name')) ) STORED,
            ADD COLUMN slip_id bigint GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.slip_id'))) STORED,
            ADD COLUMN opening_balance DECIMAL (64, 0) GENERATED ALWAYS AS (
                    CASE WHEN (json_unquote(json_extract(meta, '$.name'))) = 'capital_deposit' THEN
                        (json_unquote(json_extract(meta, '$.user_opening_balance')))
                    WHEN TYPE = 'deposit' THEN
                    (json_unquote(json_extract(meta, '$.to_opening_balance')))
                    WHEN TYPE = 'withdraw' THEN
                    (json_unquote(json_extract(meta, '$.from_opening_balance')))
                    ELSE
                        NULL
                    END) STORED;
            SQL
        );

        Schema::table("transactions", function (Blueprint $table) {
            $table->index('slip_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
