<?php

namespace App\Jobs;

use App\Actions\CreatePersonDataFromFormatterAction;
use App\Actions\SplitNamesFromStringAction;
use App\Actions\StorePersonFromPersonDataAction;
use App\Formatters\CsvNameFormatter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ImportCsvToDatabaseJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public CreatePersonDataFromFormatterAction $createPersonDataFromFormatter,
        public StorePersonFromPersonDataAction $storePersonFromPersonDataAction,
        public SplitNamesFromStringAction $splitNamesFromStringAction
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $handle = fopen(storage_path('people.csv'), 'r');
        if (! $handle) {
            throw new \Exception('Invalid file!');
        }
        fgets($handle); //Skip Header
        /** @var array<string> $names */
        $names = [];
        while (($data = fgetcsv($handle)) !== false) {
            $names[] = $data[0];
        }
        foreach ($names as $name) {
            if (Str::contains($name, ['and', '&'], true)) {
                $multipleNames = $this->splitNamesFromStringAction->execute($name);
                foreach ($multipleNames as $singleName) {
                    $this->createPerson($singleName);
                }
            } else {
                $this->createPerson($name);
            }
        }
    }

    private function createPerson(string $name): void
    {
        $this->storePersonFromPersonDataAction->execute(
            $this->createPersonDataFromFormatter->execute(new CsvNameFormatter(), $name)
        );
    }
}
