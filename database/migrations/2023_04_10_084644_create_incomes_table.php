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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->float('percent')->nullable();
            $table->string('txid')->nullable();
            $table->string('wallet')->nullable();
            $table->float('payment')->nullable();
            $table->float('amount');
            $table->string('unit');
            $table->string('status');
            $table->string('message')->nullable();
            $table->float('hash');
            $table->bigInteger('diff');
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
        Schema::dropIfExists('incomes');
    }
};
