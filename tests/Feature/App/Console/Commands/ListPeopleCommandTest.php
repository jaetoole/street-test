<?php

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('running list people command displays table of people', function () {
    $people = Person::factory(10)
        ->create()
        ->get(
            [
                'id',
                'title',
                'first_name',
                'initial',
                'last_name', ]
        );
    $this->artisan('people:list')
        ->expectsTable(
            [
                'ID',
                'Title',
                'First Name',
                'Initial',
                'Last Name',
            ],
            $people->toArray()
        )->assertSuccessful();
});
