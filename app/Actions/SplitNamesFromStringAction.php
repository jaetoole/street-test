<?php

namespace App\Actions;

use Exception;

class SplitNamesFromStringAction
{
    /**
     * @param  string  $names
     * @return array<string>
     *
     * @throws Exception
     */
    public function execute(string $names): array
    {
        /** @var array<string> $splitNames */
        $splitNames = [];
        if (preg_match('/and|&/', $names)) {
            $split = preg_split('/and|&/', $names);
            if (! $split) {
                throw new Exception('Preg Split Error');
            }
            $split = array_map(function (string $element) {
                return array_filter(explode(' ', trim($element)));
            }, $split);
            foreach ($split as $value) {
                if (count($value) === 1 && next($split) !== false) {
                    switch(count(current($split))) {
                        case 2:
                            $value[] = current($split)[1];
                            break;
                        case 3:
                            $value[] = current($split)[2];
                    }
                }
                $splitNames[] = implode(' ', $value);
            }
        }

        return $splitNames;
    }
}
