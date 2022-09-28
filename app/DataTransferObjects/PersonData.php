<?php

namespace App\DataTransferObjects;

use App\Enums\PersonTitle;

class PersonData
{
    public function __construct(
        public readonly PersonTitle $title,
        public readonly ?string $firstName,
        public readonly ?string $initial,
        public readonly string $lastName
    ) {
    }
}
