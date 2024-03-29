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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->integer('percent')->nullable();
            $table->float('minWithdrawal')->nullable();
            $table->string('wallet')->nullable();
            $table->string('name')->nullable();
            $table->float('payment')->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('group_id')
                ->on('subs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};
