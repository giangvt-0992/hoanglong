<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripDepartDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_depart_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('depart_date');
            $table->integer('available_seats')->unsigned();
            $table->text('seat_map');
            $table->bigInteger('brand_id');
            $table->bigInteger('trip_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_depart_dates');
    }
}
