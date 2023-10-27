<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('unPayments', 'pending_amount');
            $table->renameColumn('accruals', 'total_amount');
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('pending_amount', 'unPayments');
            $table->renameColumn('total_amount', 'accruals');
        });
    }
};
