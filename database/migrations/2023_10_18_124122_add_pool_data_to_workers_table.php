<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->string('name')
                ->after('worker_id')
                ->nullable();
            $table->string('status')
                ->after('approximate_hash_rate')
                ->nullable();
            $table->string('unit')
                ->after('status')
                ->nullable();
            $table->json('pool_data')
                ->after('unit')
                ->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('status');
            $table->dropColumn('unit');
            $table->dropColumn('pool_data');
            $table->dropSoftDeletes();
        });
    }
};
