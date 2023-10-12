<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->timestamp('custom_percent_expired_at')
                ->after('percent')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->dropColumn('custom_percent_expired_at');
        });
    }
};
