<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataToGudangDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gudang_detail', function (Blueprint $table) {
            //
            $table->dropColumn('sap');
            $table->dropColumn('cat');
            $table->dropColumn('satuan');
            $table->dropColumn('lokasi');
            $table->dropColumn('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gudang_detail', function (Blueprint $table) {
            //
        });
    }
}
