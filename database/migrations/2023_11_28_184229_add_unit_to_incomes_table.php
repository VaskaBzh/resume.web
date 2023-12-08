<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->string('unit')
                ->after('hash');
            $table->unsignedBigInteger('payout_id')
                ->after('referral_id')
                ->nullable();
        });

        DB::table('incomes')
            ->leftJoin('payouts', function ($join) {
                $join->on('incomes.group_id', '=', 'payouts.group_id')
                    ->whereRaw('DATE(incomes.updated_at) = DATE(payouts.created_at)');
            })
            ->update([
                'incomes.payout_id' => DB::raw('payouts.id'),
            ]);
    }

    public function down(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('unit');
            $table->dropColumn('payout_id');
        });
    }
};
