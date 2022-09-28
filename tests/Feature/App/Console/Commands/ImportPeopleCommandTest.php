<?php

use App\Jobs\ImportCsvToDatabaseJob;
use Illuminate\Support\Facades\Bus;

test('import people command dispatches job to queue', function () {
    Bus::fake();

    $this->artisan('people:import')
        ->assertSuccessful();

    Bus::assertDispatched(ImportCsvToDatabaseJob::class);
});
