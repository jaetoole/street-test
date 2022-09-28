<?php

namespace App\Contracts;

use App\DataTransferObjects\PersonData;

interface NameFormatterInterface
{
    public function format(string $name): PersonData;
}
