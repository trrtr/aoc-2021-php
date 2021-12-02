<?php

include 'Position.php';
include 'PositionWithAim.php';
include 'Submarine.php';
include 'Direction.php';
include 'Instruction.php';

/**
 * @param array<Instruction> $input
 *
 * @return int
 */
function task1(array $instructions): int
{
    $submarine = Submarine::v1();
    foreach ($instructions as $instruction) {
        $submarine->move($instruction);
    }

    return $submarine->describePosition();
}

/**
 * @param array<Instruction> $input
 *
 * @return int
 */
function task2(array $instructions): int
{
    $submarine = Submarine::v2();
    foreach ($instructions as $instruction) {
        $submarine->move($instruction);
    }

    return $submarine->describePosition();
}

$input = Utils::readInput(__DIR__ . '/input.txt');
$input = array_map(fn(string $input): Instruction => Instruction::fromString($input), $input);
echo sprintf("Solution for first task: %d\n", task1($input));
echo sprintf("Solution for second task: %d\n", task2($input));
