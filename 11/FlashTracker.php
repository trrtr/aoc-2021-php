<?php

declare(strict_types=1);

final class FlashTracker
{
    private $count = 0;

    private $counts = [];

    private CurrentStep $step;

    public function __construct(CurrentStep $step)
    {
        $this->step = $step;
    }

    public function recordFlash(): void
    {
        $step = $this->step->step();
        $this->counts[$step] = isset($this->counts[$step])
            ? $this->counts[$step] + 1
            : 1;
    }

    public function score(): int
    {
        return array_sum($this->counts);
    }

    public function lastScore(): int
    {
        return $this->counts[array_key_last($this->counts)] ?? 0;
    }
}
