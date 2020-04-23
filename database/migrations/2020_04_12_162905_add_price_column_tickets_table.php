<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceColumnTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->bigInteger('unit_price')->unsigned()->default(0);
            $table->string('code', 11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tickets', 'unit_price') && Schema::hasColumn('tickets', 'code')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('unit_price');
                $table->dropColumn('code');
            });
        }
    }
}
