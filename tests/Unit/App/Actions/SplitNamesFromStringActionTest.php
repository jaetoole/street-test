<?php

use App\Actions\SplitNamesFromStringAction;

test('two names in one string are split correctly', function (string $name, array $response) {
    $action = new SplitNamesFromStringAction();
    expect($action->execute($name))->toEqual($response);
})->with([
    ['Mr & Mrs Smith', [
        'Mr Smith',
        'Mrs Smith',
    ]],
    ['Mr and Mrs Smith', [
        'Mr Smith',
        'Mrs Smith',
    ]],
    ['Mr Test Test and Miss Testing Person', [
        'Mr Test Test',
        'Miss Testing Person',
    ]],
]);
