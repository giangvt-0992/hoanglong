<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveColumnTripDepartDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trip_depart_dates', function(Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_depart_dates', function (Blueprint $table) {
            if (Schema::hasColumn('trip_depart_dates', 'is_active')) {
                Schema::table('trip_depart_dates', function (Blueprint $table) {
                    $table->dropColumn('is_active');
                });
            }
        });
    }
}
