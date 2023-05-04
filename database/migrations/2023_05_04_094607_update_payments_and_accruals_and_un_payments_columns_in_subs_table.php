<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->decimal('payments', 10, 8)->nullable()->change();
            $table->decimal('accruals', 10, 8)->nullable()->change();
            $table->decimal('unPayments', 10, 8)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subs', function (Blueprint $table) {
            $table->bigInteger('payments')->nullable()->change();
            $table->bigInteger('unPayments')->nullable()->change();
            $table->bigInteger('accruals')->nullable()->change();
        });
    }
};
