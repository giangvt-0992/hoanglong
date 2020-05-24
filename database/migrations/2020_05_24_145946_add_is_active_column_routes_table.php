<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveColumnRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function(Blueprint $table) {
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
        Schema::table('routes', function (Blueprint $table) {
            if (Schema::hasColumn('routes', 'is_active')) {
                Schema::table('routes', function (Blueprint $table) {
                    $table->dropColumn('is_active');
                });
            }
        });
    }
}
