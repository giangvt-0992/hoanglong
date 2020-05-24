<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTripScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $dataInsert;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataInsert = [])
    {
        $this->dataInsert = $dataInsert;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        insertArrayData('trip_depart_dates', $this->dataInsert);
    }
}
