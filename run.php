<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'Utils.php';
include __DIR__ . DIRECTORY_SEPARATOR . $argv[1]. DIRECTORY_SEPARATOR . "Solution.php";

$solution = new Solution();

$input = Utils::readInput(__DIR__ . DIRECTORY_SEPARATOR . $argv[1]. DIRECTORY_SEPARATOR . 'input.txt');

$preparedInput1 = $solution->prepareInput($input);
echo sprintf('Solution for day %s task 1: %d', $argv[1], $solution->task1($preparedInput1));
echo "\n";
$preparedInput2 = $solution->prepareInput($input);
echo sprintf('Solution for day %s task 2: %d', $argv[1], $solution->task2($preparedInput2));
