<?php

declare(strict_types=1);

/**
 * @template T
 */
interface SolutionInterface
{
    public function task1(array $input): int;

    public function task2(array $input): int;
}
