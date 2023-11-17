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
            $table->unsignedBigInteger('active_sub')
                ->after('referral_discount')
                ->nullable();
        });

        Schema::table('subs', function (Blueprint $table) {
            $table->renameColumn('percent', 'allbtc_fee');

        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->string('type')->after('group_id');
        });

        Schema::drop('referrals');

        Schema::table('workers', function (Blueprint $table) {
            $table->renameColumn('approximate_hash_rate', 'hash_per_day');
        });
        Schema::table('workers', function (Blueprint $table) {
            DB::table('workers')->update(['hash_per_day' => 0]);
            $table->unsignedBigInteger('hash_per_day')
                ->change()
                ->default(0);
        });

        Schema::table('workers_hashrate', function (Blueprint $table) {
            $table->renameColumn('hash', 'hash_per_min');
        });
        Schema::table('workers_hashrate', function (Blueprint $table) {
            DB::table('workers_hashrate')->update(['hash_per_min' => 0]);
            $table->unsignedBigInteger('hash_per_min')
                ->change()
                ->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('referrer_id');
            $table->dropColumn('referral_discount');
            $table->dropColumn('referral_percent');
            $table->dropColumn('active_sub');
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

        Schema::table('workers', function (Blueprint $table) {
            $table->float('hash_per_day')
                ->default(0)
                ->change();
        });
        Schema::table('workers', function (Blueprint $table) {
            $table->renameColumn('hash_per_day', 'approximate_hash_rate');
        });

        Schema::table('workers_hashrate', function (Blueprint $table) {
            DB::table('workers_hashrate')->update(['hash_per_min' => 0]);
            $table->float('hash_per_min')
                ->change()
                ->default(0);
        });
        Schema::table('workers_hashrate', function (Blueprint $table) {
            $table->renameColumn('hash_per_min', 'hash');
        });
    }
};
