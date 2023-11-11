<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->dropColumn('payments');
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->decimal('payments')->nullable();
        });
    }
};
