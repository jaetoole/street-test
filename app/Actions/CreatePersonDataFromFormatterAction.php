<?php

namespace App\Actions;

use App\Contracts\NameFormatterInterface;
use App\DataTransferObjects\PersonData;

class CreatePersonDataFromFormatterAction
{
    public function execute(NameFormatterInterface $formatter, string $data): PersonData
    {
        return $formatter->format($data);
    }
}
