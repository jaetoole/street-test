<?php

use App\Formatters\CsvNameFormatter;

test('two people are parsed correctly', function (string $name) {
    $csvNameFormatter = new CsvNameFormatter();
    expect($csvNameFormatter->format($name)->firstName)->toBeTrue();
})->with([
    'Mr & Mrs Smith',
    'Mr and Mrs Smith',
]);
