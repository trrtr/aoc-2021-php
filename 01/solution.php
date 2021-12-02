<?php

/** @param array<int> $depths */
function task1(array $depths): int {
    $previous = array_shift($depths);
    $result = 0;
    foreach ($depths as $depth) {
        $result += (int)($depth > $previous);
        $previous = $depth;
    }

    return $result;
}

function task2(array $depths): int {
    $length = count($depths);
    return task1(array_map(
        static fn(int $a, int $b, int $c) => $a + $b + $c,
        array_slice($depths, 0, $length - 2),
        array_slice($depths, 1, $length - 2),
        array_slice($depths, 2, $length - 2),
    ));
}

$input = Utils::readInput(__DIR__ . '/input.txt');
$input = array_filter(array_map('intval', $input));
echo sprintf("Solution for first task: %d\n", task1($input));
echo sprintf("Solution for second task: %d\n", task2($input));
