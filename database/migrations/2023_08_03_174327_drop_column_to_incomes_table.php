<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('wallet');
            $table->dropColumn('percent');
            $table->dropColumn('txid');
            $table->dropColumn('unit');
        });
    }

    public function down(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->decimal('payment', 10, 8)->nullable();
            $table->string('wallet')->nullable();
            $table->float('percent')->nullable();
            $table->string('txid')->nullable();
            $table->string('unit');
        });
    }
};
