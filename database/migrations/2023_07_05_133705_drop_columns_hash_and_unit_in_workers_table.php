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
        Schema::table('workers', function (Blueprint $table) {
            if (Schema::hasColumn('workers', 'hash')) {
                $table->dropColumn('hash');
            }
            if (Schema::hasColumn('workers', 'unit')) {
                $table->dropColumn('unit');
            }
            // remove duplicates before adding unique constraint
            DB::statement('DELETE n1 FROM workers n1, workers n2 WHERE n1.id > n2.id AND n1.worker_id = n2.worker_id');
            $table->bigInteger('worker_id')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->float('hash');
            $table->string('unit');
            $table->string('worker_id')->change();
        });
    }
};
