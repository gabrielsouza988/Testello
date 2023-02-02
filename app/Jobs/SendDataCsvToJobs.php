<?php

namespace App\Jobs;

use App\Models\ShippingPrice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class SendDataCsvToJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private int $customerId;
    private string $fileName;
    private int $offset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $customerId, string $fileName, int $offset)
    {
        $this->customerId = $customerId;
        $this->fileName = $fileName;
        $this->offset = $offset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $reader = Reader::createFromPath(storage_path().'/app/public/csv/'.$this->fileName)
                            ->setDelimiter(';')
                            ->setHeaderOffset(0);

        $records = Statement::create()
                 ->offset($this->offset)
                 ->limit(1000)
                 ->process($reader);

        $rows = [];
        foreach ($records as $line) {
            $rows[] = [
                'customer_id' => $this->customerId,
                "from_postcode" => (string) $line['from_postcode'],
                "to_postcode" => (string) $line['to_postcode'],
                "from_weight" => (float) str_replace(',', '.', $line['from_weight']),
                "to_weight" => (float) str_replace(',', '.', $line['to_weight']),
                "cost" => (float) str_replace(',', '.', $line['cost']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ShippingPrice::insert($rows);
    }
}
