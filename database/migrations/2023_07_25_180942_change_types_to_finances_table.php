<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('finances', function (Blueprint $table) {
            $table->float('earn')->change();
            $table->float('user_total')->change();
            $table->float('profit')->change();
        });
    }

    public function down(): void
    {
        Schema::table('finances', function (Blueprint $table) {
            $table->unsignedBigInteger('earn')->change();
            $table->unsignedBigInteger('user_total')->change();
            $table->unsignedBigInteger('profit')->change();
        });
    }
};
