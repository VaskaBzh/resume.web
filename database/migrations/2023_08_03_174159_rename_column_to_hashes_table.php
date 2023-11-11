<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hashes', function (Blueprint $table) {
            $table->renameColumn('amount', 'worker_count');
        });
    }

    public function down(): void
    {
        Schema::table('hashes', function (Blueprint $table) {
            $table->renameColumn('worker_count', 'amount');
        });
    }
};
