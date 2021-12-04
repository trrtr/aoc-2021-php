<?php

declare(strict_types=1);

final class Processor
{
    private int $processed = 0;

    /** @var array<int> */
    private array $currentState;

    public function process(Binary $bits): void
    {
        if (!isset($this->currentState)) {
            $this->currentState = array_fill(0, count($bits->bits()), 0);
        }
        $this->currentState = array_map(
            fn (Bit $bit, ?int $state): int => $bit->toInt() + $state,
            $bits->bits(),
            $this->currentState
        );
        $this->processed++;
    }

    public function epsilon(): Binary
    {
        $epsilon = array_map(fn(int $sum) => $sum >= $this->processed / 2 ? 1 : 0, $this->currentState);

        return Binary::fromString(implode('', $epsilon));
    }
}
