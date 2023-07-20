<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->float('percent')
                ->after('accruals')
                ->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->dropColumn('percent');
        });
    }
};
