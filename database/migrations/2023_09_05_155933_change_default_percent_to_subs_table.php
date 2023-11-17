<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->unsignedFloat('percent')->default(3.5)->change();
        });
    }

    public function down(): void
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->unsignedFloat('percent')->default(0)->change();
        });
    }
};
