<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\ResultSet;

class RegisterShippingTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ResultSet $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $row = [];
        foreach ($records as $line) {
            $row[] = $line;
        }
        dd($row);
    }
}
