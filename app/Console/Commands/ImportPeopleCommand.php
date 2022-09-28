<?php

namespace App\Console\Commands;

use App\Actions\CreatePersonDataFromFormatterAction;
use App\Actions\SplitNamesFromStringAction;
use App\Actions\StorePersonFromPersonDataAction;
use App\Jobs\ImportCsvToDatabaseJob;
use Illuminate\Console\Command;

class ImportPeopleCommand extends Command
{
    protected $signature = 'people:import';

    protected $description = 'Import people from a pre-existing CSV file.';

    public function __construct(
        public CreatePersonDataFromFormatterAction $createPersonDataFromFormatter,
        public StorePersonFromPersonDataAction $storePersonFromPersonDataAction,
        public SplitNamesFromStringAction $splitNamesFromStringAction
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        ImportCsvToDatabaseJob::dispatch(
            $this->createPersonDataFromFormatter,
            $this->storePersonFromPersonDataAction,
            $this->splitNamesFromStringAction
        );
        $this->info('Import CSV To Database job dispatched. Run php artisan people:list to see all records.');

        return 0;
    }
}
