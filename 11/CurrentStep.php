<?php

declare(strict_types=1);

final class CurrentStep
{
    public function __construct(private $step = 0)
    {
    }

    public function step(): int
    {
        return $this->step;
    }

    public function increment(): void
    {
        $this->step++;
    }
}
