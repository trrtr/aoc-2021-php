<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'Utils.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'SolutionInterface.php';

$filesToInclude = [];
foreach (scandir(__DIR__ . DIRECTORY_SEPARATOR . $argv[1]) as $file) {
    if (str_ends_with($file, '.php')) {
        $filesToInclude[] = __DIR__ . DIRECTORY_SEPARATOR . $argv[1] . DIRECTORY_SEPARATOR . $file;
    }
}
includeAll($filesToInclude);

function includeAll($filesToInclude) {
    $postponed = [];
    foreach ($filesToInclude as $file) {
        try {
            include $file;
        } catch (Throwable $exception) {
            $postponed[] = $file;
        }
    }
    if (empty($postponed)) {
        return;
    }
    includeAll($postponed);
}

$solution = new Solution();

$input = Utils::readInput(__DIR__ . DIRECTORY_SEPARATOR . $argv[1] . DIRECTORY_SEPARATOR . 'input.txt');

$preparedInput1 = $solution->prepareInput($input);
echo sprintf('Solution for day %s task 1: %d', $argv[1], $solution->task1($preparedInput1));
echo "\n";
$preparedInput2 = $solution->prepareInput($input);
echo sprintf('Solution for day %s task 2: %d', $argv[1], $solution->task2($preparedInput2));
