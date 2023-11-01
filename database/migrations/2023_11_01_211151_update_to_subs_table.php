<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->unsignedBigInteger('referrer_id')
                ->after('group_id')
                ->nullable();
            $table->unsignedDecimal('referrer_percent')
                ->after('percent')
                ->nullable();
            $table->unsignedDecimal('referral_percent')
                ->after('referrer_percent')
                ->nullable();
            $table->renameColumn('percent', 'allbtc_fee');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->string('referral_id')->change();
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->renameColumn('referral_id', 'type');
        });

        Schema::drop('referrals');
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->dropColumn('referrer_id');
            $table->renameColumn('allbtc_fee', 'percent');
            $table->dropColumn('referrer_percent');
            $table->dropColumn('referral_percent');
        });

        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedDecimal('referral_percent');
            $table->timestamp('expired_at')->nullable();
            $table->unique(['user_id', 'group_id']);
            $table->timestamps();
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->renameColumn('type', 'referral_id');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedInteger('referral_id')->change();
        });
    }
};
