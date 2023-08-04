<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->renameColumn('amount', 'daily_amount');
        });
    }

    public function down(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->renameColumn('daily_amount', 'amount');
        });
    }
};