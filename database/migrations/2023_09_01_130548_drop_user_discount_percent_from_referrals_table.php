<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropColumn('user_discount_percent');
            $table->renameColumn('sub_profit_percent', 'referral_percent');
        });
    }

    public function down(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->float('user_discount_percent')->after('group_id');
            $table->renameColumn('referral_percent', 'sub_profit_percent');
        });
    }
};
