<?php

declare(strict_types=1);

final class Solution implements SolutionInterface
{
    public function task1($input): int
    {
        $results = array_column($input, 'result');
        $flatDigits = array_merge(...$results);
        $knownDigits = array_filter($flatDigits, fn (string $digit): bool => in_array(strlen($digit), [2,3,4,7]));

        return count($knownDigits);
    }

    public function task2($input): int
    {
        $rawWirings = array_column($input, 'pattern');
        $results = array_column($input, 'result');
        $wirings = array_map(fn(array $patterns) => new Wiring($patterns), $rawWirings);
        $iterator = new MultipleIterator();
        $iterator->attachIterator(new ArrayIterator($wirings));
        $iterator->attachIterator(new ArrayIterator($results));

        $displayed = [];
        foreach ($iterator as [$wiring, $digits]) {
            $stringNumber = array_map(fn(string $digit) => $wiring->getNumber($digit), $digits);
            $displayed[] = (int)implode('', $stringNumber);
        }

        return array_sum($displayed);
    }

    public function prepareInput(array $input): array
    {
        $input = array_filter($input);
        $patternAndResults = array_map(fn(string $line): array => explode(' | ', $line), $input);
        $mappedToDigits = array_map(
            fn(array $patternAndResult) => [
                'pattern' => explode(' ', $patternAndResult[0]),
                'result' => explode(' ', $patternAndResult[1]),
            ],
            $patternAndResults
        );

        return $mappedToDigits;
    }
}
