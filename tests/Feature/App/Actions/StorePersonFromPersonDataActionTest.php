<?php

use App\Actions\StorePersonFromPersonDataAction;
use App\DataTransferObjects\PersonData;
use App\Enums\PersonTitle;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a person is create in the database from a PersonData DTO instance', function () {
    $personData = new PersonData(
        title: PersonTitle::MR,
        firstName: fake()->firstName,
        initial: null,
        lastName: fake()->lastName
    );

    (new StorePersonFromPersonDataAction())->execute($personData);

    expect(
        Person::query()->first()->only(['title', 'first_name', 'last_name'])
    )->toEqual(
        [
            'title' => PersonTitle::MR,
            'first_name' => $personData->firstName,
            'last_name' => $personData->lastName,
        ]
    );
});
