<?php

namespace App\Jobs;

use App\Models\ShippingPrice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use League\Csv\Reader;
use League\Csv\Statement;

class RegisterDataShippingTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private string $fileName;
    private string $folderSave;
    private int $customerId;
    private int $offset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $fileName, string $folderSave, int $customerId, int $offset)
    {
        $this->fileName = $fileName;
        $this->folderSave = $folderSave;
        $this->customerId = $customerId;
        $this->offset = $offset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $rows = $this->getRows();
        ShippingPrice::insert($rows);
    }

    /**
     * Get rows from CSV file.
     *
     * @return array
     */
    private function getRows(): array
    {
        $reader = Reader::createFromPath(
            storage_path("app/public/{$this->folderSave}/{$this->fileName}")
        )->setDelimiter(';')->setHeaderOffset(0);

        $records = Statement::create()
            ->offset($this->offset)
            ->limit(1000)
            ->process($reader);

        $rows = [];
        foreach ($records as $line) {
            $rows[] = [
                'customer_id' => $this->customerId,
                "from_postcode" => (string) filter_var($line['from_postcode'], FILTER_UNSAFE_RAW),
                "to_postcode" => (string) filter_var($line['to_postcode'], FILTER_UNSAFE_RAW),
                "from_weight" => (float) str_replace(',', '.', $line['from_weight']),
                "to_weight" => (float) str_replace(',', '.', $line['to_weight']),
                "cost" => (float) str_replace(',', '.', $line['cost']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $rows;
    }
}
