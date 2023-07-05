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
        Schema::create('workers_hashrate', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('worker_id');
            $table->float('hash');
            $table->string('unit');
            $table->string('amount');
            $table->timestamps();

            $table->foreign('worker_id')
                ->references('worker_id')
                ->on('workers')
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
        Schema::dropIfExists('workers_hashrate');
    }
};
