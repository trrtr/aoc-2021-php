<?php

declare(strict_types=1);

include __DIR__ . '/Number.php';

final class Line
{
    private int $numberOfMarked = 0;

    /** @var array<Number> */
    private array $numbers;

    /**
     * @param array<int> $numbers
     */
    public function __construct(array $numbers)
    {
        $this->numbers = array_map(fn(int $number) => new Number($number), $numbers);
    }

    public function tryMarking(int $numberToMark): void
    {
        foreach ($this->numbers as $number) {
            if ($number->number === $numberToMark) {
                $number->mark();
                $this->numberOfMarked++;
            }
        }
    }

    public function areAllMarked(): bool
    {
        return $this->numberOfMarked === count($this->numbers);
    }
}
