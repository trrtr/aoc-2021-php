<?php

declare(strict_types=1);

include __DIR__ . '/../SolutionInterface.php';
include __DIR__ . '/Binary.php';
include __DIR__ . '/Processor.php';

/**
 * @implements<Binary>
 */
final class Solution implements SolutionInterface
{
    public function task1(array $input): int
    {
        $processor = new Processor();
        foreach ($input as $bits) {
            $processor->process($bits);
        }

        $epsilon = $processor->epsilon();
        $gamma = $epsilon->flip();

        return $epsilon->toInt() * $gamma->toInt();
    }

    public function task2(array $input): int
    {
        return $this->oxygen($input, 0)->toInt() * $this->co2($input, 0)->toInt();
    }

    public function oxygen(array $input, int $position)
    {
        if (count($input) === 1) {
            return array_pop($input);
        }

        $processor = new Processor();
        foreach ($input as $in) {
            $processor->process($in);
        }

        $epsilon = $processor->epsilon();

        return $this->oxygen(
            array_filter(
                $input,
                fn(Binary $tested) => $tested->isTheSameOnPosition($position, $epsilon)
            ),
            $position+1
        );
    }

    public function co2(array $input, int $position)
    {
        if (count($input) === 1) {
            return array_pop($input);
        }

        $processor = new Processor();
        foreach ($input as $in) {
            $processor->process($in);
        }

        $epsilon = $processor->epsilon();
        $gamma = $epsilon->flip();

        return $this->co2(
            array_filter(
                $input,
                fn(Binary $tested) => $tested->isTheSameOnPosition($position, $gamma)
            ),
            $position+1
        );
    }

    /**
     * @param array<Binary> $filteredInput
     * @param Binary $filter
     *
     * @return Binary
     */
    private function filter(array $filteredInput, Binary $filter): Binary
    {
        foreach ($filter->bits() as $position => $bit) {
            $filteredInput = array_filter(
                $filteredInput,
                fn(Binary $tested) => $tested->isTheSameOnPosition($position, $bit)
            );
            if (count($filteredInput) <= 1) {
                return $filteredInput[array_key_first($filteredInput)];
            }
        }

        throw new Exception('somethithwrong');
    }

    /**
     * @param array<string> $taskInput
     *
     * @return array<Binary>
     */
    public function prepareInput(array $taskInput): array
    {
        return array_map(static fn(string $input): Binary => Binary::fromString($input), $taskInput);
    }
}
