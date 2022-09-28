<?php

namespace App\Actions;

use App\DataTransferObjects\PersonData;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;

class StorePersonFromPersonDataAction
{
    /**
     * @param  PersonData  $personData
     * @return Person|Builder <Person>
     */
    public function execute(PersonData $personData): Person | Builder
    {
        return Person::query()
            ->create(
                [
                    'title' => $personData->title->value,
                    'first_name' => $personData->firstName,
                    'initial' => $personData->initial,
                    'last_name' => $personData->lastName,
                ]
            );
    }
}
