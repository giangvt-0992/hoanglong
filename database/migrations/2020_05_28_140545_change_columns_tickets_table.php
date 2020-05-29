<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumns('tickets', ['pickup_place_id', 'unit_price'])) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('pickup_place_id');
                $table->dropColumn('unit_price');
            });
        }
        Schema::table('tickets', function(Blueprint $table) {
            $table->enum('status', ['unpaid', 'paid', 'cancel'])->default('unpaid');
            $table->json('trip_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('tickets', ['status', 'trip_info'])) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('status');
                $table->dropColumn('trip_info');
            });
        }

        Schema::table('tickets', function(Blueprint $table) {
            $table->bigInteger('pickup_place_id');
            $table->bigInteger('unit_price')->unsigned()->default(0);
        });
    }
}
