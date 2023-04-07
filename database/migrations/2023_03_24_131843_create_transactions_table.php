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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_id');
            $table->json('tickers')->nullable();
//            $table->string('wallet_address');
//            $table->decimal('amount', 16, 8);
//            $table->string('percent');
//            $table->string('txid');
//            $table->enum('status', ['pending', 'approved', 'rejected', 'completed']);
            $table->timestamps();

            $table->foreign('sub_id')
                ->references('id')
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
        Schema::dropIfExists('transactions');
    }
};
