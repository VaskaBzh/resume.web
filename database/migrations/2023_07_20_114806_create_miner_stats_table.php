<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('minerstats', function (Blueprint $table) {
            $table->id();
            $table->decimal('network_hashrate', 5);
            $table->string('network_unit');

            $table->unsignedBigInteger('network_difficulty');
            $table->unsignedBigInteger('next_difficulty');
            $table->string("change_difficulty");

            $table->decimal('reward_block', 8, 7);
            $table->unsignedBigInteger('price_USD');

            $table->timestamp('time_remain');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minerstats');
    }
};
