<?php

use App\Actions\CreatePersonDataFromFormatterAction;
use App\Contracts\NameFormatterInterface;

test('creating a person data instance from a formatter works', function () {
    $name = 'Mr Joe Bloggs';
    $mock = Mockery::mock(NameFormatterInterface::class);
    $mock->expects('format')
        ->once()
        ->with($name);

    (new CreatePersonDataFromFormatterAction())->execute($mock, $name);
});
