<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('payments', 'total_payment');
            $table->renameColumn('accruals', 'total_amount');
            $table->renameColumn('unPayments', 'un_payments');
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('total_payment', 'payments');
            $table->renameColumn('total_amount', 'accruals');
            $table->renameColumn('un_payments', 'unPayments');
        });
    }
};
