<?php

namespace App\Formatters;

use App\Contracts\NameFormatterInterface;
use App\DataTransferObjects\PersonData;
use App\Enums\PersonTitle;

class CsvNameFormatter implements NameFormatterInterface
{
    public function format(string $name): PersonData
    {
        $array = explode(' ', $name);

        return new PersonData(
            title: PersonTitle::from($array[0]),
            firstName: (strlen($array[1]) > 2 && count($array) > 2) ? $array[1] : null,
            initial: (strlen($array[1]) <= 2 && count($array) > 2) ? substr($array[1], 0, 1) : null,
            lastName: (count($array) > 2) ? $array[2] : $array[1]
        );
    }
}
