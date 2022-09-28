<?php

namespace App\Console\Commands;

use App\Models\Person;
use Illuminate\Console\Command;

class ListPeopleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'people:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all people in the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $people = Person::query()->get(['id', 'title', 'first_name', 'initial', 'last_name']);
        $this->table(
            [
                'ID',
                'Title',
                'First Name',
                'Initial',
                'Last Name',
            ],
            $people->toArray()
        );

        return 0;
    }
}
