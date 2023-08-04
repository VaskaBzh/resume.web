<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('finances', function (Blueprint $table) {
            $table->decimal('earn', 10, 8, true)->change();
            $table->decimal('user_total', 10, 8, true)->change();
            $table->decimal('profit', 10, 8, true)->change();
        });
    }

    public function down(): void
    {
        Schema::table('finances', function (Blueprint $table) {
            $table->float('earn')->change();
            $table->float('user_total')->change();
            $table->float('profit')->change();
        });
    }
};
