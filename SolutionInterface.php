<?php

declare(strict_types=1);

/**
 * @template T
 */
interface SolutionInterface
{
    public function task1($input): int;

    public function task2($input): int;

    public function prepareInput(array $input): array;
}
