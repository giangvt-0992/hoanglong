<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddValueStatusColumnTicketsTable extends Migration
{
    private $set_schema_table = "tickets";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE ".$this->set_schema_table." MODIFY COLUMN status ENUM('unpaid', 'paid', 'cancel','refund', 'not refund yet') NOT NULL DEFAULT 'unpaid'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE ".$this->set_schema_table." MODIFY COLUMN status ENUM('unpaid', 'paid', 'cancel') NOT NULL DEFAULT 'unpaid'");
    }
}
