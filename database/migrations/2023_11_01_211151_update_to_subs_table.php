<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('referrer_id')
                ->after('email')
                ->nullable();
            $table->unsignedDecimal('referral_percent')
                ->after('referrer_id')
                ->nullable();
            $table->unsignedDecimal('referral_discount')
                ->after('referral_percent')
                ->nullable();
        });

        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('percent', 'allbtc_fee');

        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->string('type')->after('group_id');
        });

        Schema::drop('referrals');
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('referrer_id');
            $table->dropColumn('referral_discount');
            $table->dropColumn('referral_percent');
        });
        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('allbtc_fee', 'percent');
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
            $table->dropColumn('type');
        });
    }
};
