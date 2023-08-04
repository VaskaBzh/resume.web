<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('miner_stats', function (Blueprint $table) {
            $table->float('fpps_rate')->after('reward_block');
        });
    }

    public function down(): void
    {
        Schema::table('miner_stats', function (Blueprint $table) {
            $table->dropColumn('fpps_rate');
        });
    }
};