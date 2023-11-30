<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->unsignedFloat('percent')
                ->change();
        });

        Schema::table('referrals', function (Blueprint $table) {
            $table->unsignedFloat('referral_percent')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->float('percent')->change();
        });

        Schema::table('referrals', function (Blueprint $table) {
            $table->float('referral_percent')
                ->change();
        });
    }
};
